<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header class="py-2">
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Получение токена') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Токен выдается один раз. При его генерации сохраните его для последующего использования. При необходимости токен можно пересоздать.') }}
                            </p>
                        </header>
                        <a href="{{ route('create.token') }}" class="flex items-center gap-4">
                            <x-primary-button>{{ __('Получить токен') }}</x-primary-button>
                        </a>
                        @if(session('token'))
                            <h2 class="pt-2 text-lg font-medium text-gray-900 dark:text-gray-100">
                                Ваш API токен: {{ session('token') }}
                            </h2>
                        @endif
                        @error('error_token')
                            <p class="mt-1 text-sm text-gray-900 dark:text-gray-400">
                                {{ $message }}
                            </p>
                        @enderror
                    </section>
                </div>
            </div>
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
