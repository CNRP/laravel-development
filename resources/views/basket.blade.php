<x-guest-layout>
    <div class="bg-white p-2.5 md:p-6">
        @if ($basketType == "basket")
            <h1 class="text-2xl font-bold mb-4">Basket</h1>
        @endif
        @if ($basketType == "checkout")
            <h1 class="text-2xl font-bold mb-4">Checkout Successful</h1>
        @endif

        @if ($errors->has('error'))
            <div class="alert alert-danger">
                {{ $errors->first('error') }}
            </div>
        @endif
        @if (count($basketItems) > 0)
            <table class="border-collapse w-full">
{{--                <caption class="caption-top py-2">--}}
{{--                    Thank you for shopping with us! any questions feel free to contact us.--}}
{{--                </caption>--}}
                <thead>
                <tr>
                    <th class="border-b-2 px-4 py-2 hidden md:block">Img</th>
                    <th class="border-b-2 px-4 py-2">Name</th>
                    <th class="border-b-2 px-4 py-2">Price</th>
                    <th class="border-b-2 px-4 py-2">Quantity</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($basketItems as $productId => $basketItem)
                    @if ($basketItem['product'])
                        <tr>
                            <td class="border px-4 py-2 hidden md:block"><img src="{{ $basketItem['product']->image_url }}" class="h-16 w-full object-contain"></td>
                            <td class="border sm:px-0 md:px-4 py-2">{{ $basketItem['product']->name }}</td>
                            <td class="border sm:px-0 md:px-4 py-2 text-center">£{{ $basketItem['product']->price_value }}</td>
                            <td class="border">
                                <div class="flex justify-center">
                                    <div class="flex items-center">
                                        <p class="quantity-info">{{ $basketItem['quantity'] }}</p>
                                        @if ($basketType == "basket")
                                        <a href="#" class="ml-4 edit-quantities-btn bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded"><i class="fas fa-edit"></i>
                                            <span class="sm:inline-block hidden">Edit</span></a>
                                        @endif
                                    </div>
                                    <div class="basket-forms-container hidden flex items-center" data-product-id="{{ $productId }}">
                                        <form class="mr-2" action="{{ route('basket.update', ['productId' => $productId]) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="stripe_id" value="{{ $basketItem['product']->stripe_id }}">
                                            <input type="number" name="quantity" value="{{ $basketItem['quantity'] }}" min="1" class="quantity-input w-16 mr-2">
                                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded"><i class="fas fa-check"></i></button>
                                        </form>
                                        <form action="{{ route('basket.remove', $productId) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="stripe_id" value="{{ $basketItem['product']->stripe_id }}">
                                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">Remove</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
            <div class="flex-col w-full text-right mt-6">
                <p class="text-lg font-semibold">Items: <span class="text-green-600">{{ $totalQuantity }}</span></p>
                <p class="text-lg font-semibold">Basket Total: <span class="text-green-600">£{{ $totalCost }}</span></p>
            </div>

            @if ($basketType == "basket")
            <div class="flex justify-between mt-4">
                <form action="{{ route('basket.empty') }}" method="POST">
                    @csrf
                    <button class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded" type="submit">Empty Cart</button>
                </form>
                <form action="{{ route('stripe.process') }}" method="POST">
                    @csrf
                    <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Checkout Cart</button>
                </form>
            </div>
            @else
                <div class="flex justify-end mt-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="hidden md:block bg-gray-600 hover:bg-gray-700 px-4 py-2 rounded-md text-sm font-medium text-white">
                            <i class="fas fa-user-circle mr-2"></i>Dashboard</a>
                    @else
                        {{--                            <a href="{{ route('login') }}" class="">Log in</a>--}}
                        <a href="{{ route('login') }}" class="hidden md:block bg-gray-600 hover:bg-gray-700 px-4 py-2 rounded-md text-sm font-medium text-white">
                            <i class="fas fa-sign-in-alt mr-2"></i>Login</a>
                        <a href="{{ route('register') }}" class="ml-4 hidden md:block bg-gray-600 hover:bg-gray-700 px-4 py-2 rounded-md text-sm font-medium text-white">
                            <i class="fas fa-user mr-2"></i>Register</a>
                    @endauth
                </div>
            @endif
        @else
            <p class="mt-4">No items in the cart.</p>
        @endif
    </div>
</x-guest-layout>
