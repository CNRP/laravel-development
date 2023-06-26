

<x-guest-layout>
    <div class="min-1200 bg-white p-4 md:p-8 featured-products">
        @if ($product)
            <h1 class="font-semibold text-2xl">{{ $product->name }}</h1>

            <div class="mt-6">
                <div class="flex flex-col-reverse items-center sm:flex-row">
                    <div class="mr-8">
                        <p class="text-gray-700"><span class="font-semibold w-full block mb-4">Description:</span> {{ $product->description }}</p>
                        <p class="text-gray-700 my-4"><span class="font-semibold">Price:</span> £{{ $product->price_value }}</p>
                    </div>
                    <div class="mr-4 mb-4">
                        <img src="{{ $product->image_url }}" class="h-34" alt="Product Image">
                    </div>
                </div>
            </div>
            <x-add-remove-basket-buttons :product="$product" />
        @else
            <h1 class="font-semibold text-2xl">Hey, something went wrong..</h1>
            <p>No product found.</p>
        @endif
    </div>
</x-guest-layout>
