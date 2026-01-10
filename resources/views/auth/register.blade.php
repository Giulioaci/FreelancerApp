<x-guest-layout>
    <!-- Titolo sotto il logo -->
    <div class="text-center mt-4">
        <h1 class="text-2xl font-semibold text-gray-900">
            Registrati
        </h1>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Nome -->
        <div>
            <x-input-label for="name" :value="__('Nome')" />
            <x-text-input
                id="name"
                class="block mt-1 w-full"
                type="text"
                name="name"
                :value="old('name')"
                required
                autofocus
                autocomplete="name"
            />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input
                id="email"
                class="block mt-1 w-full"
                type="email"
                name="email"
                :value="old('email')"
                required
                autocomplete="username"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input
                id="password"
                class="block mt-1 w-full"
                type="password"
                name="password"
                required
                autocomplete="new-password"
                minlength="8"
                pattern="(?=.*[A-Z])(?=.*[0-9])(?=.*[\W_]).{8,}"
                title="La password deve contenere almeno 8 caratteri, una lettera maiuscola, un numero e un simbolo"
            />

            <!-- Requisiti password -->
            <ul class="mt-2 text-sm text-gray-600 list-disc list-inside">
                <li>Almeno 8 caratteri</li>
                <li>Almeno una lettera maiuscola</li>
                <li>Almeno un numero</li>
                <li>Almeno un simbolo (!@#$%^&*)</li>
            </ul>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Conferma Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Conferma Password')" />
            <x-text-input
                id="password_confirmation"
                class="block mt-1 w-full"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
            />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Azioni -->
        <div class="flex items-center justify-end mt-6">
            <a
                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md
                       focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}"
            >
                {{ __('Già sei registrato?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Registrati') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>


