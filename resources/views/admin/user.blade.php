<x-app-layout>
    <x-slot name="header">
        <hgroup class="flex">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit user: ') }}
            </h2>
            <h2 class="ml-2">
                {{ $user->email }}
            </h2>
        </hgroup>
    </x-slot>
</x-app-layout>
