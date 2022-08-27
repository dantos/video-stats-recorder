var player;
var videoId;
var timeElapsed = 0;
var timeElapsedCollection = [];
var videoWasRated = false;
var videoStats = [];
var audioStats = [];
var url = '';

function init() {
  var videoElement = document.querySelector('.videoContainer video');
  player = dashjs.MediaPlayer().create();
  player.initialize(videoElement, url, true);
  var controlbar = new ControlBar(player);
  controlbar.initialize();

  setListeners();
}

function setListeners() {
  player.on(dashjs.MediaPlayer.events['PLAYBACK_TIME_UPDATED'], startStatsTracking);
  player.on(dashjs.MediaPlayer.events['PLAYBACK_PAUSED'], onVideoPaused);
  player.on(dashjs.MediaPlayer.events['PLAYBACK_ENDED'], onVideoEnd);
  player.on(dashjs.MediaPlayer.events['PLAYBACK_STARTED'], function (){
    $('#pauseButton').text('Pause');
  });
}

init();

function stopVideo() {
  player.reset();
  player.destroy();
  timeElapsedCollection = [];
  videoWasRated = false;
}

function pauseVideo() {
  $("#playPauseBtn").click();
}

function onVideoEnd() {
  clearData();
  timeElapsed = 0;
  showRateVideoDialog();
}

function onVideoPaused() {

  $('#pauseButton').text('Resume');

  saveStats(videoStats, audioStats);
  clearData();
  if( Object.keys(timeElapsedCollection).length > 10 ){
    showRateVideoDialog();
    timeElapsedCollection = [];
  }
}

function clearData() {
  videoStats = [];
  audioStats = [];
}

function startStatsTracking(e){
  getDashData(e, 'video');
  getDashData(e, 'audio');
}

function getDashData(event, type) {

  timeElapsed = Math.floor(event.time);
  timeElapsedCollection[timeElapsed] = timeElapsed;

  if( timeElapsed >= 5 && timeElapsed % 5 == 0){
    saveStats(videoStats, audioStats);
    clearData();
  }

  var streamInfo = player.getActiveStream().getStreamInfo();
  var dashMetrics = player.getDashMetrics();
  var dashAdapter = player.getDashAdapter();
  var bandwidthValue = 0;
  var bitrateIndexValue = 0;
  var pendingIndex = 0;
  var bufferLengthValue = 0;
  var droppedFramesValue = 0;
  var download = 0;
  var latency = 0;
  var ratio = 0;

  if (dashMetrics && streamInfo) {

    var repSwitch = dashMetrics.getCurrentRepresentationSwitch(type, true);
    var bufferLengthValue = dashMetrics.getCurrentBufferLevel(type, true);
    var httpRequest = dashMetrics.getHttpRequests(type);
    var droppedFramesMetrics = dashMetrics.getCurrentDroppedFrames();
    var activeStream = player.getActiveStream();

    if (repSwitch !== null && activeStream) {
      var periodIdx = activeStream.getStreamInfo().index;
      bitrateIndexValue = dashAdapter.getIndexForRepresentation(repSwitch.to, periodIdx);
      bandwidthValue = dashAdapter.getBandwidthForRepresentation(repSwitch.to, periodIdx);
      bandwidthValue = bandwidthValue / 1000;
      bandwidthValue = Math.round(bandwidthValue);
    }

    if (httpRequest !== null) {

      var httpMetrics = calculateHTTPMetrics(type, httpRequest);

      if (httpMetrics) {
        latency = httpMetrics.latency[type].average.toFixed(2);
        download = httpMetrics.download[type].average.toFixed(2);
        ratio = httpMetrics.ratio[type].average.toFixed(2);
      }
    }

    if (droppedFramesMetrics !== null) {
      droppedFramesValue = droppedFramesMetrics.droppedFrames;
    }

    if (isNaN(bandwidthValue) || bandwidthValue === undefined) {
      bandwidthValue = 0;
    }

    if (isNaN(bitrateIndexValue) || bitrateIndexValue === undefined) {
      bitrateIndexValue = 0;
    }

    if (isNaN(bufferLengthValue) || bufferLengthValue === undefined) {
      bufferLengthValue = 0;
    }

    pendingValue = player.getQualityFor(type);
    bandwidthValue = bandwidthValue + 1;
    pendingIndex = (pendingValue !== bitrateIndexValue) ? pendingValue + 1 : 0;
    droppedFramesValue = droppedFramesValue;

  }

  let data = {
    'time' : event.time,
    'buffer_length' : bufferLengthValue,
    'bitrate_downloading' : bandwidthValue,
    'index_downloading' : pendingIndex,
    'index_playing' : bitrateIndexValue,
    'dropped_frames' : droppedFramesValue,
    'bufferLengthValue' : bufferLengthValue,
    'latency' : latency,
    'download' : download,
    'ratio' : ratio,
    'type' : type,
  }

  if( type == 'video' ){
    if(typeof  videoStats[timeElapsed] === 'undefined') {
      videoStats[timeElapsed] = data;
    }
  }

  if( type == 'audio' ){
    if(typeof audioStats[timeElapsed] === 'undefined') {
      audioStats[timeElapsed] = data;
    }
  }
}

function calculateHTTPMetrics(type, requests) {
  var latency = {},
    download = {},
    ratio = {};

  var requestWindow = requests.slice(-20).filter(function (req) {
    return req.responsecode >= 200 && req.responsecode < 300 && req.type === 'MediaSegment' && req._stream === type && !!req._mediaduration;
  }).slice(-4);

  if (requestWindow.length > 0) {
    var latencyTimes = requestWindow.map(function (req) {
      return Math.abs(req.tresponse.getTime() - req.trequest.getTime()) / 1000;
    });

    latency[type] = {
      average: latencyTimes.reduce(function (l, r) {
        return l + r;
      }) / latencyTimes.length,
      high: latencyTimes.reduce(function (l, r) {
        return l < r ? r : l;
      }),
      low: latencyTimes.reduce(function (l, r) {
        return l < r ? l : r;
      }),
      count: latencyTimes.length
    };

    var downloadTimes = requestWindow.map(function (req) {
      return Math.abs(req._tfinish.getTime() - req.tresponse.getTime()) / 1000;
    });

    download[type] = {
      average: downloadTimes.reduce(function (l, r) {
        return l + r;
      }) / downloadTimes.length,
      high: downloadTimes.reduce(function (l, r) {
        return l < r ? r : l;
      }),
      low: downloadTimes.reduce(function (l, r) {
        return l < r ? l : r;
      }),
      count: downloadTimes.length
    };

    var durationTimes = requestWindow.map(function (req) {
      return req._mediaduration;
    });

    ratio[type] = {
      average: (durationTimes.reduce(function (l, r) {
        return l + r;
      }) / downloadTimes.length) / download[type].average,
      high: durationTimes.reduce(function (l, r) {
        return l < r ? r : l;
      }) / download[type].low,
      low: durationTimes.reduce(function (l, r) {
        return l < r ? l : r;
      }) / download[type].high,
      count: durationTimes.length
    };

    return {
      latency: latency,
      download: download,
      ratio: ratio
    };

  }
  return null;
}

async function ajaxService(url, params, method) {
  return await $.ajax( {
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: url,
    type: method,
    dataType: 'json',
    data: { data : params }
  });
}

async function saveStats(videoData, audioData) {
  const url = 'video/'+videoId+'/stats';

  try {

    if( videoData != '' ){
      await ajaxService(url, videoData, 'POST');
    }

    if( audioData != '' ){
      await ajaxService(url, audioData, 'POST');
    }

  } catch (error) {

  }
}

function showRateVideoDialog() {

  if( !videoWasRated ) {

    Swal.fire({
      title: 'How do you rate this video?',
      icon: 'warning',
      html:
        'How good was it?<br/><br/>' +
        `
          <div id="rating-container">
              <div class="flex justify-center items-center">
                  <div class="flex items-center" id="stars-container">
                      <svg onclick="drawRating(1)" data-score="1" class="rating-star mx-1 w-4 h-4 fill-current text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                      <svg onclick="drawRating(2)" class="rating-star mx-1 w-4 h-4 fill-current text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                      <svg onclick="drawRating(3)" class="rating-star mx-1 w-4 h-4 fill-current text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                      <svg onclick="drawRating(4)" class="rating-star mx-1 w-4 h-4 fill-current text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                      <svg onclick="drawRating(5)" class="rating-star mx-1 w-4 h-4 fill-current text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                  </div>
              </div>
          </div>
        ` +
        '<input type="hidden" id="rater" min="0" max="5" value="0">',
      showCancelButton: true,
      confirmButtonColor: '#428bca',
      cancelButtonColor: '#fa6b6b',
      cancelButtonText: 'Later...',
      confirmButtonText: 'Rate',
      allowOutsideClick: false,
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function () {
            $("#rater").val(0);
            videoWasRated = true;
            Swal.fire(
              'Rated!',
              'Your rating has been sent.',
              'success'
            )
          },
          url: 'video/' + videoId + '/rate',
          type: 'POST',
          dataType: 'json',
          data: {data: {"score": $("#rater").val()}}
        });
      }
      timeElapsedCollection = [];
    });
  }
}

function drawRating(score) {

  $("#rating-container").hide();

  let stars = ``;
  let qty = parseInt(score);
  qty = qty > 5 ? 5 : qty;

  let filledStarCount = 0;

  for (let i = 0; i < qty; i++) {
    stars = stars +
      `<svg onclick="drawRating(${i+1})" class="rating-star mx-1 w-4 h-4 fill-current text-yellow-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>`;
    filledStarCount = i+1;
  }

  //loop starts with the amount of stars unselected
  for (let i = filledStarCount+1; i <= 5; i++) {
    stars = stars +
      `<svg onclick="drawRating(${i})" class="rating-star mx-1 w-4 h-4 fill-current text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>`
  }

  $("#rater").val(filledStarCount);
  $("#stars-container").html(stars);
  $("#rating-container").show();

}