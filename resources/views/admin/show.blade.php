<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Administrator Tools') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-4">
                    <h3>Users</h3>
                    <table class="w-full border-collapse">
                        <thead class="font-semibold text-md">
                            <tr>
                                <td>{{ __('ID') }}</td>
                                <td>{{ __('Email') }}</td>
                                <td>{{ __('Superuser') }}</td>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>
                                    {{ $user->id }}
                                </td>
                                <td>
                                    {{ $user->email }}
                                </td>
                                <td>
                                    {{ $user->superuser }}
                                </td>
                                <td class="pr-4">
                                    <form method="get" action="{{ route('admin.user', ['id' => $user->id]) }}">
                                        <x-primary-button>{{ __('Edit') }}</x-primary-button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class='px-4'>
                    {{ $users->links() }}
                </div>
            </div>
            <div class="mt-1 bg-white shadow-sm sm:rounded-lg">
                <div class="p-4">
                    <hgroup>
                        <h3>Links</h3>
                    </hgroup>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
