<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Videos') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="create-button-container">
                        <a href="{{route('videos.create')}}" class="py-2 px-4 mt-8 bg-indigo-500 text-white rounded-md shadow-xl">Create</a>
                    </div>
                    <div class="bg-white shadow-md rounded my-6">
                        <table class="min-w-max w-full table-auto">
                            <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">Name</th>
                                <th class="py-3 px-6 text-left">Provider</th>
                                <th class="py-3 px-6 text-left">Url</th>
                                <th class="py-3 px-6 text-left">Creation Date</th>
                                <th class="py-3 px-6 text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm font-light">
                                @foreach($videos as $index => $video)
                                    <tr class="border-b border-gray-200 hover:bg-gray-100 {{($index%2 == 0) ? '' : 'bg-gray-50'}}">
                                        <td class="py-3 px-6 text-left whitespace-nowrap">
                                            <div class="flex items-center">
                                                <span class="font-medium truncate" style="width: 300px">{{$video->name}}</span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-6 text-left whitespace-nowrap">
                                            <div class="flex items-center">
                                                <span class="font-medium">{{$video->provider}}</span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-6 text-left whitespace-nowrap">
                                            <div class="flex items-center">
                                                <span class="font-medium truncate" style="width: 300px">{{$video->url}}</span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-6 text-left whitespace-nowrap">
                                            <div class="flex items-center">
                                                <span class="font-medium">{{$video->created_at}}</span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-6 text-center">
                                            <div class="flex item-center justify-center">
                                                <a href="{{route('videos.edit', ['video' => $video->id])}}" class="w-4 mr-2 transform hover:text-purple-400 hover:scale-110">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                    </svg>
                                                </a>
                                                <button onclick="deleteVideo({{$video->id}})" class="w-4 mr-2 transform hover:text-purple-400 hover:scale-110">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div id="delete-form-container"></div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            function deleteVideo(videoId){
                
              Swal.fire({
                title: "You're about to delete this video",
                text: 'Do you wish to continue?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#428bca',
                cancelButtonColor: '#fa6b6b',
                cancelButtonText: 'Cancel',
                confirmButtonText: 'Delete',
                allowOutsideClick: false,
              }).then((result) => {
                if (result.isConfirmed) {
                  let csfr = $('meta[name="csrf-token"]').attr('content');
                  let deleteForm =
                    `
                    <form id="remove-form" method="POST" action="videos/${videoId}">
                        <input name="_token" value="${csfr}" type="hidden">
                        <input type="hidden" name="_method" value="DELETE">
                    </form>
                    `;

                  $("#delete-form-container").html(deleteForm);
                  $("#delete-form-container form").submit();
                }
              });
            }
        </script>
    @endpush
</x-app-layout>
