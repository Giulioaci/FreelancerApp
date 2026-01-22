<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-gray-800 leading-tight">Upgrade a PRO</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

        
            <div class="bg-white shadow rounded-xl p-6">
                <h3 class="text-lg font-medium mb-4">Passa al piano PRO</h3>
                <p class="mb-6">
                    Con il piano PRO puoi avere clienti illimitati, accesso completo alle funzionalità avanzate e supporto prioritario.
                </p>

                @if($user->plan === 'free')
                    {{-- Pulsante Stripe Checkout --}}
                    <button
                        id="checkout-button"
                        class="w-full px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition"
                    >
                        🎉 Diventa PRO
                    </button>

                    {{-- Stripe JS --}}
                    <script src="https://js.stripe.com/v3/"></script>
                    <script>
                        const stripe = Stripe("{{ env('STRIPE_KEY') }}"); // la tua chiave pubblica

                        const checkoutButton = document.getElementById('checkout-button');
                        checkoutButton.addEventListener('click', () => {
                            fetch("{{ route('upgrade.pro') }}", {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/json",
                                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                },
                            })
                            .then(response => response.json())
                            .then(session => {
                                return stripe.redirectToCheckout({ sessionId: session.id });
                            })
                            .then(result => {
                                if (result.error) {
                                    alert(result.error.message);
                                }
                            })
                            .catch(err => console.error(err));
                        });
                    </script>
                @else
                    <div class="p-4 bg-green-50 border border-green-200 text-green-800 rounded">
                        ✅ Sei un utente PRO: clienti illimitati!
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>




