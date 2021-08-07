<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-col m-auto mb-4 space-y-4 lg:space-y-0 lg:flex-row lg:items-center lg:space-x-4">
                        <div class="select-wrapper">
                            <select class="video-selector">
                                <option value=""></option>
                                @foreach($videos as $video)
                                    <option value="{{$video->id}}">[{{$video->provider}}] {{$video->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="select-wrapper">
                            <label for="toggle" class="text-xs text-gray-700">Video</label>
                            <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                                <input type="checkbox" name="toggle" id="type-toggle" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"/>
                                <label for="toggle" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                            </div>
                            <label for="toggle" class="text-xs text-gray-700">Audio</label>
                        </div>
                    </div>
                    <div id="buffer-length-graph-container"></div>
                </div>
            </div>
        </div>
    </div>
    @push('styles')
        <style>


            .highcharts-figure, .highcharts-data-table table {
                min-width: 310px;
                max-width: 800px;
                margin: 1em auto;
            }

            .highcharts-data-table table {
                font-family: Verdana, sans-serif;
                border-collapse: collapse;
                border: 1px solid #EBEBEB;
                margin: 10px auto;
                text-align: center;
                width: 100%;
                max-width: 500px;
            }
            .highcharts-data-table caption {
                padding: 1em 0;
                font-size: 1.2em;
                color: #555;
            }
            .highcharts-data-table th {
                font-weight: 600;
                padding: 0.5em;
            }
            .highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
                padding: 0.5em;
            }
            .highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
                background: #f8f8f8;
            }
            .highcharts-data-table tr:hover {
                background: #f1f7ff;
            }
        </style>
        <style>
            /* CHECKBOX TOGGLE SWITCH */
            /* @apply rules for documentation, these do not work as inline style */
            .toggle-checkbox:checked {
                @apply: right-0 border-green-400;
                right: 0;
                border-color: #68D391;
            }
            .toggle-checkbox:checked + .toggle-label {
                @apply: bg-green-400;
                background-color: #68D391;
            }
            [type='checkbox']:checked {
                background-size: 50% 50%;
                background-color: wheat;
                background-image: url("data:image/svg+xml,%3Csvg id='Layer_1' data-name='Layer 1' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 122.88 96.65'%3E%3Ctitle%3Esound%3C/title%3E%3Cpath d='M11,22.84H36.47L58.17,1A3.44,3.44,0,0,1,63,1a3.39,3.39,0,0,1,1,2.44h0V93.2a3.46,3.46,0,0,1-5.93,2.41L36.65,77.49H11a11,11,0,0,1-11-11V33.83a11,11,0,0,1,11-11Zm65.12,15a3.22,3.22,0,1,1,6.1-2,43.3,43.3,0,0,1,1.56,13.27c-.09,4.76-.78,9.44-2.13,12.21a3.23,3.23,0,1,1-5.8-2.83c.93-1.92,1.43-5.59,1.5-9.48a37.13,37.13,0,0,0-1.23-11.12Zm16.64-12a3.23,3.23,0,0,1,6-2.48c3,7.18,4.61,16.23,4.75,25.22s-1.17,17.72-4,24.77a3.22,3.22,0,1,1-6-2.4C96,64.64,97.15,56.66,97,48.6s-1.58-16.36-4.28-22.81Zm16.09-10.23a3.22,3.22,0,1,1,5.8-2.8,86.65,86.65,0,0,1,8.24,36.44c.09,12.22-2.37,24.39-7.73,34.77a3.22,3.22,0,0,1-5.73-3c4.88-9.43,7.11-20.56,7-31.77a80,80,0,0,0-7.6-33.69ZM37.89,29.74H11A4.11,4.11,0,0,0,6.9,33.83V66.51A4.11,4.11,0,0,0,11,70.6h26.9s2,.69,2.21.83L57.16,85.8v-74L40.52,28.53a3.46,3.46,0,0,1-2.63,1.21Z'/%3E%3C/svg%3E");
            }
        </style>
    @endpush
    @push('scripts')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <script>

      $(document).ready(function() {
        $('.video-selector').select2({
          placeholder: "Please select a video...",
        });

        $('.video-selector').on('select2:select', function (e) {
          let videoId = e.params.data.id;
          let graphType = $('#type-toggle').is(':checked') ? 'audio' : 'video';

          if( videoId != '' ){
            loadGraphs(videoId, graphType);
          }
        });

        $('#type-toggle').change(function() {
          let videoId = $('.video-selector').select2('data')[0].id;
          let graphType = this.checked ? 'audio' : 'video';

          if( videoId != '' ){
            loadGraphs(videoId, graphType);
          }
        });
      });


      async function ajaxService(url, params, method) {
        return await $.ajax( {
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          beforeSend: function (){
            $('.video-selector').prop('disabled', true);
            $('#type-toggle').prop('disabled', true)
          },
          success: function (){
            $('.video-selector').prop('disabled', false);
            $('#type-toggle').prop('disabled', false)

          },
          url: url,
          type: method,
          dataType: 'json',
          data: { data : params }
        });
      }
      async function loadGraphs(videoId, type) {
        const url = 'video/'+videoId+'/stats?graph=0';

        try {

          let chart1Data = await ajaxService(url, {"graph" : 0, "type": type}, 'GET');
          createChart1(chart1Data);

          // let chart2Data = await ajaxService(url, {"graph" : 1, "type": type}, 'GET');
          // createChart2(chart1Data);
          //
          // let chart3Data = await ajaxService(url, {"graph" : 2, "type": type}, 'GET');
          // createChart3(chart1Data);

        } catch (error) {

        }
      }

      function createChart1(data) {
        Highcharts.chart('buffer-length-graph-container', {
          chart: {
            zoomType: 'x',
            type: 'spline',
          },
          title: {
            text: 'DASH'
          },
          subtitle: {
            text: 'Buffer Level, Dropped FPS, Bitrate (kbps)'
          },
          time: {
            useUTC: true
          },

          xAxis: {
            tickPixelInterval: 150,
            crosshair: true,
            title: {
              text: 'Time (in seconds)'
            }
          },
          yAxis: [
            {
              opposite: true,
              gridLineWidth: 0,
              title: {
                text: 'Buffer Level',
                style: {
                  color: '#ff7900'
                }
              },
              min: 0,
              plotLines: [{
                value: 1,
                width: 1,
                color: '#808080'
              }]
            },
            {
              gridLineWidth: 0,
              title: {
                text: 'Dropped FPS',
                style: {
                  color: '#136bfb'
                }
              },
              min: 0,
              plotLines: [{
                value: 1,
                width: 1,
                color: '#808080'
              }]
            },
            {
              opposite: true,
              gridLineWidth: 0,
              title: {
                text: 'Bitrate (kbps)',
                style: {
                  color: '#00CCBE'
                }
              },
              min: 0,
              plotLines: [{
                value: 1,
                width: 1,
                color: '#808080'
              }]
            },

          ],
          tooltip: {
            shared: true,
            headerFormat: '<b>DASH</b><br>',
          },

          plotOptions: {
            lineWidth: 4,
            states: {
              hover: {
                lineWidth: 5
              }
            },
            series: {
              marker: {
                enabled: true
              }
            }
          },

          colors: ['#136bfb', '#00CCBE', '#ff7900',],

          series: [
            {
              type: 'column',
              yAxis: 1,
              name: "Dropped Frames",
              data: data.dropped_frames
            },
            {
              type: 'spline',
              yAxis: 2,
              name: "Bitrate Downloading",
              data: data.bitrate_downloading,
              marker: {
                enabled: false
              },
              dashStyle: 'shortdot',
            },
            {
              type: 'spline',
              name: "Buffer Length",
              data: data.buffer_length
            }],
          responsive: {
            rules: [{
              condition: {
                maxWidth: 500
              },
              chartOptions: {
                legend: {
                  floating: false,
                  layout: 'horizontal',
                  align: 'center',
                  verticalAlign: 'bottom',
                  x: 0,
                  y: 0
                },
                yAxis: [{
                  labels: {
                    align: 'right',
                    x: 0,
                    y: -6
                  },
                  showLastLabel: false
                }, {
                  labels: {
                    align: 'left',
                    x: 0,
                    y: -6
                  },
                  showLastLabel: false
                }, {
                  visible: false
                }]
              }
            }]
          }
        });
      }

    </script>
    @endpush

</x-app-layout>
