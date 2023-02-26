<x-app-layout>
    <x-slot name="header">
        <hgroup class="flex">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Link: ') }}
            </h2> 
            <h2 class="ml-2">
                {{ $link->shortcode }}
            </h2>
        </hgroup>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="post" action="{{ route('link.update', ['shortcode' => $link->shortcode]) }}" class="mt-6 space-y-6">
                       @csrf      
                       @method('patch')

                       <div>
                           <x-input-label for="url" :value="__('URL')" />
                           <x-text-input id="url" type="text" name="url" class="mt-1 block w-full" :value="old('url', $link->url)" required autofocus />
                           <x-input-error class="mt-2" :messages="$errors->get('url')" />
                       </div>

                       <div class="flex items-center gap-4">
                           <x-primary-button>{{ __('Save') }}</x-primary-button>

                           @if (session('status') == "link-updated")
                           <p x-data="{show: true}" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">
                                {{ __('Saved.') }}
                           </p>
                           @endif
                       </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
