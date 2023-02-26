<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your links') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl">
           @if (session('status') == "not-authorized")
           <p x-data="{show: true}" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-lg text-red-600">
                {{ __('You do not own that link.') }}
           </p>
           @elseif (session('status') == 'no-such-link')
           <p x-data="{show: true}" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-lg text-red-600">
                {{ __('No link with the specified shortcode exists.') }}
           </p>
           @elseif (session('status') == 'link-created')
           <p x-data="{show: true}" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-lg text-green-600">
                {{ __('New link created.') }}
           </p>
           @elseif (session('status') == 'link-deleted')
           <p x-data="{show: true}" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-lg text-green-600">
                {{ __('Link deleted.') }}
           </p>
           @endif
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-4">
                    <table class="w-full border-collapse">
                        <thead class="font-semibold text-xl">
                            <tr>
                                <td>{{ __('Shortcode') }}</td>
                                <td>{{ __('URL') }}</td>
                                <td>{{ __('Visit Count') }}</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($links as $link)
                            <tr class="max-h-4">
                                <td>{{ $link->shortcode }}</td>
                                <td>{{ $link->url }}</td>
                                <td>{{ $link->visits_count }}</td>
                                <td class="pr-4">
                                    <form method="get" action="{{ route('link.edit', ['shortcode' => $link->shortcode]) }}">
                                        <x-primary-button>{{ __('Edit') }}</x-primary-button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
