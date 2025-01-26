<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Zapomniałeś hasła? Nie ma problemu. Podaj nam adres e-mail, a my wyślemy Ci link do resetowania hasła, który pozwoli Ci wybrać nowe.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mr-4" href="{{ route('login') }}">
                {{ __('Wróć do logowania') }}
            </a>
            <x-primary-button>
                {{ __('Wyślij link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
