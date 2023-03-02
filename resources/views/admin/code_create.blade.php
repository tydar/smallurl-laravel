<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Registration Code') }}
        </h2> 
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="post" action="{{ route('admin.code_store') }}" class="mt-6 space-y-6">
                       @csrf      
                       @method('post')

                       <div>
                           <x-input-label for="code" :value="__('Code')" />
                           <x-text-input id="code" type="text" name="code" class="mt-1 block w-full" :value="old('code')" required autofocus />
                           <x-input-error class="mt-2" :messages="$errors->get('code')" />
                       </div>

                       <div>
                           <x-input-label for="max_redemptions" :value="__('Max Redemptions')" />
                           <x-text-input id="max_redemptions" type="text" name="max_redemptions" class="mt-1 block w-full" :value="old('max_redemptions')" required />
                           <x-input-error class="mt-2" :messages="$errors->get('max_redemptions')" />
                       </div>

                       <div class="flex items-center gap-4">
                           <x-primary-button>{{ __('Save') }}</x-primary-button>
                       </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
