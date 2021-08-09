<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex">
                        <div class="flex flex-col m-auto space-y-4 lg:space-y-0 lg:flex-row lg:items-center lg:space-x-4">
                            <div class="select-wrapper">
                                <select class="video-selector">
                                    @foreach($videos as $video)
                                        <option data-id="{{$video->id}}" value="{{$video->url}}">[{{$video->provider}}] {{$video->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="stopButton" class="py-2 px-4 mt-8 bg-red-400 text-white rounded-md shadow-xl cursor-pointer hover:bg-red-500 hover:text-gray-100">Stop</div>
                            <div id="loadButton" class="py-2 px-4 mt-8 bg-indigo-400 text-white rounded-md shadow-xl cursor-pointer hover:bg-indigo-500 hover:text-gray-100">Load</div>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="dash-video-player m-auto">
                            <div class="videoContainer" id="videoContainer">
                                <video preload="" autoplay=""></video>
                                <div id="videoController" class="video-controller unselectable">
                                    <div id="playPauseBtn" class="btn-play-pause" title="Play/Pause">
                                        <span id="iconPlayPause" class="icon-play"></span>
                                    </div>
                                    <span id="videoTime" class="time-display">00:00:00</span>
                                    <div id="fullscreenBtn" class="btn-fullscreen control-icon-layout" title="Fullscreen">
                                        <span class="icon-fullscreen-enter"></span>
                                    </div>
                                    <div id="bitrateListBtn" class="control-icon-layout" title="Bitrate List">
                                        <span class="icon-bitrate"></span>
                                    </div>
                                    <input type="range" id="volumebar" class="volumebar" value="1" min="0" max="1" step=".01"/>
                                    <div id="muteBtn" class="btn-mute control-icon-layout" title="Mute">
                                        <span id="iconMute" class="icon-mute-off"></span>
                                    </div>
                                    <div id="trackSwitchBtn" class="control-icon-layout" title="A/V Tracks">
                                        <span class="icon-tracks"></span>
                                    </div>
                                    <div id="captionBtn" class="btn-caption control-icon-layout" title="Closed Caption">
                                        <span class="icon-caption"></span>
                                    </div>
                                    <span id="videoDuration" class="duration-display">00:00:00</span>
                                    <div class="seekContainer">
                                        <div id="seekbar" class="seekbar seekbar-complete">
                                            <div id="seekbar-buffer" class="seekbar seekbar-buffer"></div>
                                            <div id="seekbar-play" class="seekbar seekbar-play"></div>
                                        </div>
                                    </div>
                                    <div id="thumbnail-container" class="thumbnail-container">
                                        <div id="thumbnail-elem" class="thumbnail-elem"></div>
                                        <div id="thumbnail-time-label" class="thumbnail-time-label"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('styles')
        <style>
            .select2-container {
                min-width: 200px;
                max-width: 800px;
            }
        </style>
    @endpush
    @push('scripts')
        <script src="{{ asset('js/dash.all.min.js') }}"></script>
        <script src="{{ asset('js/ControlBar.js') }}"></script>
        <script src="{{ asset('js/video.js') }}"></script>
        <script>

          $(document).ready(function() {
            $('.video-selector').select2();

            $('#loadButton').click(function (){
              videoId = $('.video-selector').select2().find(":selected").data('id');
              url = $('.video-selector').select2('data')[0].id;
              stopVideo();
              init();
            });

            $('#stopButton').click(function (){
              stopVideo();
            });

          });
        </script>
    @endpush
</x-app-layout>
