<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-indigo-600 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex justify-center">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <stripe-checkout></stripe-checkout>
            </div>
        </div>
    </div>
</x-app-layout>