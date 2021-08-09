<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create User') }}
        </h2>
    </x-slot>
    <x-auth-card class="min-h-0">
        <x-slot name="logo"></x-slot>
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form method="POST" action="{{ route('users.store') }}">
        @csrf

        <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-80" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-80" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Role -->
            <div class="mt-4">
                <x-label for="role" :value="__('Role')" />
                <select name="role" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-80" id="">
                    <option {{ old('role') == 'user' ? 'selected' : ''  }} value="user">User</option>
                    <option {{ old('role') == 'admin' ? 'selected' : ''  }} value="admin">Administrator</option>
                    <option {{ old('role') == 'guest' ? 'selected' : ''  }} value="guest">Guest</option>
                </select>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-80"
                         type="password"
                         name="password"
                         required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4">
                    {{ __('Save') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-app-layout>
