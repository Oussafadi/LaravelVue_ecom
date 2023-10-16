<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-indigo-600 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <!-- Remove py-8 -->
                <div class="mx-auto container px-6 py-6">
                    <div class="grid grid-cols-4 gap-4">
                        @foreach ($products as $product)
                        <!-- Card 1 -->
                        <div tabindex="0" class="focus:outline-none  w-72">
                            <div>
                                <img alt="person capturing an image" src="{{ $product->image }}" tabindex="0" class="focus:outline-none w-full h-44" />
                            </div>
                            <div class="bg-white">
                                <div class="flex items-center justify-start px-2 pt-3">

                                    <div class="bg-yellow-200 py-1.5 px-4 rounded-full">
                                        <p tabindex="0" class="focus:outline-none text-2xs font-bold text-orange-800">{{ $product->price }} MAD</p>
                                    </div>
                                </div>
                                <div class="p-4">
                                    <div class="flex items-center">
                                        <h2 tabindex="0" class="focus:outline-none text-lg text-orange-700 font-bold">{{ $product->description}}</h2>
                                        <p tabindex="0" class="focus:outline-none text-xs text-gray-600 pl-5"></p>
                                    </div>
                                    <p tabindex="0" class="focus:outline-none text-xs text-black mt-2">{{ $product->name}}</p>

                                    <add-to-cart :product-id="{{ $product->id }}"></add-to-cart>
                                </div>
                            </div>
                        </div>
                        <!-- Card 1 Ends -->
                        @endforeach
                    </div>
                </div>
                <!--- more free and premium Tailwind CSS components at https://tailwinduikit.com/ --->

            </div>
        </div>
    </div>
</x-app-layout>