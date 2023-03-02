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
                    <div class="flex">
                        <h3 class="font-semibold text-lg mr-1">{{ __('Registration Codes') }}</h3>
                        <form class="ml-1" method="get" action="{{ route('admin.code_create') }}">
                            <x-primary-button>{{ __('New Code') }}</x-primary-button>
                        </form>
                    </div>
                    <table class="w-full border-collapse">
                        <thead class="font-semibold text-md">
                            <tr>
                                <td>{{ __('ID') }}</td>
                                <td>{{ __('Code') }}</td>
                                <td>{{ __('Redemption Count') }}</td>
                                <td>{{ __('Max Redemptions') }}</td>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($codes as $code)
                            <tr>
                                <td>
                                    {{ $code->id }}
                                </td>
                                <td>
                                    {{ $code->code }}
                                </td>
                                <td>
                                    {{ $code->redemption_count }}
                                </td>
                                <td>
                                    {{ $code->max_redemptions }}
                                </td>
                                <td class="pr-4">
                                    <form method="get" action="{{ route('admin.code_edit', ['id' => $code->id]) }}">
                                        <x-primary-button>{{ __('Edit') }}</x-primary-button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class='px-4'>
                    {{ $codes->links() }}
                </div>
            </div>
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-4">
                    <h3 class="font-semibold text-lg">{{ __('Users') }}</h3>
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
