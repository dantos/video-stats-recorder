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
                    <div id="buffer-length-graph-container"></div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <script>
      async function ajaxService(url, params, method) {
        return await $.ajax( {
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: url,
          type: method,
          dataType: 'json',
          data: {}
        });
      }
      async function loadGraph1(videoData, audioData) {
        const url = 'video/1/stats?graph=0';

        try {

          let data = await ajaxService(url, audioData, 'GET');
          createChart1(data);

        } catch (error) {
          console.log('Error: ', error);
        }
      }
      loadGraph1();

      function createChart1(data) {
        Highcharts.chart('buffer-length-graph-container', {
          chart: {
            type: 'spline'
          },
          title: {
            text: 'DASH'
          },
          subtitle: {
            text: 'Buffer Level, Dropped FPS, Bitrate (kbps)'
          },
          time: {
            useUTC: false
          },

          xAxis: {
            type: 'datetime',
            dateTimeLabelFormats: {
              second: '%H:%M:%S',
              day: '%e. %b',
            },
            tickPixelInterval: 150,
            crosshair: true,
            title: {
              text: 'Date'
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
            headerFormat: '<b>{series.name}</b><br>',
          },

          plotOptions: {
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

</x-app-layout>
