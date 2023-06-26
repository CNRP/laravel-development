<?php
use App\Models\Product;
//$products = Product::fetchFromStripe();
$products = Product::all();
?>
<x-guest-layout>

    <div class="Products">
        <h1 class="text-white my-4 font-bold font-sans text-4xl">products</h1>
        @if (session('success'))
            <div class="bg-white my-5 p-2 px-4 text-xl shadow-lg rounded-lg text-green-600">
                {{ session('success') }} <a href="/basket">View Cart</a>
            </div>
        @endif
        @if (session('error'))
            <div class="bg-white my-5 p-2 px-4 text-xl shadow-lg rounded-lg text-green-600">
                {{ session('error') }} <a href="/basket">View Cart</a>
            </div>
        @endif
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 grid-flow-row">
            @foreach ($products as $product)
                <div class="relative bg-white p-4 shadow-lg rounded-md overflow-hidden flex flex-col justify-between min-250">
                    <p class="price-tag text-xl bg-green-600 text-white py-1 px-3 font-bold right-4 top-4 absolute">£{{ $product->price_value }}</p>
                    <a href="/products/{{ $product->stripe_id }}">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="py-4 w-full h-38 object-cover">
                        <div class="p-2">
                            <h2 class="text-xl font-semibold mb-2">{{ $product->name }}</h2>
                            <p class="line-clamp-4 mb-2 text-gray-700">{{ $product->description }}</p>
                        </div>
                    </a>
                    <x-add-remove-basket-buttons :product="$product" />
                </div>
            @endforeach
        </div>
    </div>

</x-guest-layout>
