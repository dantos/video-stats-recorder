<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Video') }}
        </h2>
    </x-slot>
    <x-auth-card class="min-h-0">
        <x-slot name="logo"></x-slot>
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form method="POST" action="{{ route('videos.update', ['video' => $video->id]) }}">
        @csrf

        <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-80" type="text" name="name" value="{{ empty(old('name')) ? $video->name : old('name') }}" required autofocus />
            </div>

            <!-- Provider -->
            <div class="mt-4">
                <x-label for="provider" :value="__('Provider')" />

                <x-input id="provider" class="block mt-1 w-80" type="text" name="provider" value="{{ empty(old('provider')) ? $video->provider : old('provider') }}" required />
            </div>

            <!-- Url -->
            <div class="mt-4">
                <x-label for="url" :value="__('Url')" />

                <x-input id="url" class="block mt-1 w-80" type="text" name="url" value="{{ empty(old('url')) ? $video->url : old('url') }}" required />
            </div>


            @method('PATCH')

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4">
                    {{ __('Save') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-app-layout>
