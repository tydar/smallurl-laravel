<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your links') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-4">
                    <table class="w-full border-collapse">
                        <thead class="font-semibold text-xl">
                            <tr>
                                <td>Shortcode</td>
                                <td>URL</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($links as $link)
                            <tr class="max-h-4">
                                <td>{{ $link->shortcode }}</td>
                                <td>{{ $link->url }}</td>
                                <td class="pr-4">
                                    <a href="{{ route('link.edit', ['link' => $link->shortcode]) }}">
                                        <div class="text-white text-center p-2 rounded bg-gray-800">Edit</div>
                                    </a>
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
