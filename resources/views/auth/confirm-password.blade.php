<x-guest-layout>
    <div class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-br from-gray-50 to-gray-200 px-4">
        <div class="w-full sm:max-w-md bg-white/90 backdrop-blur shadow-md sm:rounded-lg p-6 transition duration-300 hover:shadow-lg">
            
            <div class="mb-4 text-sm text-gray-600">
                {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
            </div>

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <!-- Password -->
                <div class="mb-4">
                    <x-input-label for="password" :value="__('Password')" class="text-gray-700" />

                    <x-text-input id="password" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600" />
                </div>

                <div class="flex justify-end mt-4">
                    <x-primary-button class="bg-blue-600 hover:bg-blue-700 transition duration-200">
                        {{ __('Confirm') }}
                    </x-primary-button>
                </div>
            </form>

        </div>
    </div>
</x-guest-layout>

