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
                    <header>
                        <hgroup class="flex">
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Total visits:') }}
                            </h2>
                            <h2 class="text-lg ml-2">
                                {{ $link->visits_count }}
                            </h2>
                        </hgroup>

                        <table class="w-full border-collapse">
                            <thead class="font-semibold text-md">
                                <tr>
                                    <td>{{ __('Visit Time') }}</td>
                                    <td>{{ __('IP Address') }}</td>
                                </tr>
                                <tr>
                                    <td class="font-light mt-4 text-sm text-gray-600">
                                        {{ __("Most recent five visitors.") }}
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($recent_visits as $visit)
                                <tr>
                                    <td>
                                        {{ $visit->created_at }}
                                    </td>
                                    <td>
                                        {{ $visit->ip }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </header>
                </div>
            </div>

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

                           <x-danger-button formmethod="get" formaction="{{ route('link.delete', ['shortcode' => $link->shortcode]) }}">
                                {{ __('Delete') }}
                            </x-danger-button>

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
