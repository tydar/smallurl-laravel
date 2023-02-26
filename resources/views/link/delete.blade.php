<x-app-layout>
    <x-slot name="header">
        <hgroup class="flex">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Delete Link: ') }}
            </h2> 
            <h2 class="ml-2">
                {{ $link->shortcode }}
            </h2>
        </hgroup>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                Are you sure you want to delete this link?
                <div class="max-w-xl">
                    <form method="post" action="{{ route('link.destroy', ['shortcode' => $link->shortcode]) }}" class="mt-6 space-y-6">
                    @csrf
                    @method('delete')
                    <div class="flex items-center gap-4"> 
                        <x-danger-button formaction="{{ route('link.destroy', ['shortcode' => $link->shortcode]) }}">
                            {{ __('Delete') }}
                        </x-danger-button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
