<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-indigo-600 leading-tight">
            The cart contents
        </h2>
    </x-slot>
    <div class="py-12">
        <div class=" rounded-md mx-auto sm:px-6 lg:px-8">
            <shopping-cart></shopping-cart>
        </div>
    </div>
</x-app-layout>