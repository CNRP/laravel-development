<h1>yo</h1>
@productInBasket($product)
<form action="{{ route('basket.remove') }}" method="POST">
    @csrf
    <input type="hidden" name="stripe_id" value="{{ $product->stripe_id }}">
    <button class="flex justify-center whitespace-nowrap bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
        <i class="fa-solid fa-xmark mr-2"></i>
        <span>Remove From Cart</span>
    </button>
</form>
@else
    <form action="{{ route('basket.add') }}" class="__add_to_cart" method="POST">
        @csrf
        <input type="hidden" name="stripe_id" value="{{ $product->stripe_id }}">
        <input class="text-center w-16 py-2 px-4 text-sm leading-tight bg-white border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-300" type="number" name="quantity" value="1" min="1">
        <button class="whitespace-nowrap bg-green-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 ml-4 rounded">
            <i class="fas fa-shopping-cart mr-2"></i>
            <span>Add To Cart</span>
        </button>
    </form>
@endproductInBasket
