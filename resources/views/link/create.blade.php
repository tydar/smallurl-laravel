
<x-app-layout>
    <x-slot name="header">
        <hgroup class="flex">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('New link') }}
            </h2> 
        </hgroup>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="post" action="{{ route('link.store') }}" class="mt-6 space-y-6">
                       @csrf      

                       <div>
                           <x-input-label for="shortcode" :value="__('Shortcode')" />
                           <x-text-input id="shortcode" type="text" name="shortcode" class="mt-1 block w-full" :value="old('shortcode', __('Shortcode') . '...')" required autofocus />
                           <x-input-error class="mt-2" :messages="$errors->get('shortcode')" />
                       </div>

                       <div>
                           <x-input-label for="url" :value="__('URL')" />
                           <x-text-input id="url" type="text" name="url" class="mt-1 block w-full" :value="old('url', __('URL') . '...')" required />
                           <x-input-error class="mt-2" :messages="$errors->get('url')" />
                       </div>

                       <div class="flex items-center gap-4">
                           <x-primary-button>{{ __('Shorten URL') }}</x-primary-button>
                       </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
