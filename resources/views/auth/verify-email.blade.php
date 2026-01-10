<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Grazie per esserti registrato! Per iniziare, verifica il tuo indirizzo email cliccando sul link che ti abbiamo appena inviato. Se non hai ricevuto l’email, possiamo inviartene un’altra senza problemi.') }}
    </div>

    <!-- Status messaggio -->
    @if (session('status') == 'verification-link-sent')
        <x-auth-session-status class="mb-4" :status="__('Un nuovo link di verifica è stato inviato all\'indirizzo email fornito durante la registrazione.')" />
    @endif

    <div class="flex flex-col gap-3">
        <!-- Invio nuovo link di verifica -->
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <x-primary-button class="w-full">
                {{ __('Invia nuovamente l\'email di verifica') }}
            </x-primary-button>
        </form>

        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Esci') }}
            </button>
        </form>
    </div>
</x-guest-layout>


