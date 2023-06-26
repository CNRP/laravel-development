<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Laravel\Cashier\Checkout;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class BasketController extends Controller
{
    public function addToBasket(Request $request){

        $stripeId = $request->input('stripe_id');
        $quantity = $request->input('quantity');
        $product = Product::where('stripe_id', $stripeId)->first();

        if ($product) {
            $basket = session()->get('basket', []);
            // Check if the product already exists in the cart
            $existingProduct = collect($basket)->first(function ($item) use ($product) {
                return $item['product'] && $item['product']->stripe_id === $product->stripe_id;
            });

            if ($existingProduct) {
                // Product.php already exists in the cart, update the quantity
                $existingProduct['quantity'] += $quantity;
            } else {
                // Product.php is new, add it to the cart
                $basket[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                ];
            }
            session()->put('basket', $basket);
            return redirect()->back()->with('success', 'Product.php added to cart.');
        }
        return redirect()->back()->with('error', 'Product.php not found.');
    }

    public function viewBasket(Request $request){
        // Retrieve cart items from the session
        $basketItems = session()->get('basket', []);
        // Calculate the total number of items in the cart
        $totalItems = collect($basketItems)->sum('quantity');

        $basketTotal = 0;
        foreach ($basketItems as $productId => $basketItem) {
            if ($basketItem['product']) {
                $basketTotal += $basketItem['product']->price_value * $basketItem['quantity'];
            }
        }

        $editingQuantities = $request->session()->has('editingQuantities');
        return view('basket', [
            'basketItems' => $basketItems,
            'basketType' => 'basket',
            'totalQuantity' => $totalItems,
            'totalCost' => $basketTotal,
            'editingQuantities' => $editingQuantities,
        ]);
    }

    public function countBasket(Request $request){
        // Retrieve cart items from the session
        $basketItems = session()->get('basket', []);
        return sizeof($basketItems);
    }

    public function checkProductInBasket($product){
        $basketItems = session()->get('basket', []);

        foreach ($basketItems as $productId => $basketItem) {
            if ($basketItem['product']->stripe_id === $product->stripe_id) {
                return true;
            }
        }
        return false;
    }

    public function update(Request $request)
    {
        // Retrieve the cart items from the session
        $basketItems = session()->get('basket', []);

        // Validate the request data
        $request->validate([
            'stripe_id' => 'required',
            'quantity' => 'required|numeric|min:1',
        ]);

        $stripeId = $request->input('stripe_id');

        // Find the item with the matching stripe_id
        $productIndex = null;
        foreach ($basketItems as $index => $basketItem) {
            if ($basketItem['product']->stripe_id === $stripeId) {
                $productIndex = $index;
                break;
            }
        }

        // Update the quantity for the specified stripe_id
        if ($productIndex !== null) {
            $basketItems[$productIndex]['quantity'] = $request->input('quantity');
            session()->put('basket', $basketItems);
            return redirect()->back()->with('success', 'Product quantity updated successfully.');
        }

        return redirect()->back()->with('error', 'Product not found in the basket.');
    }

    public function emptyBasket(){
        // Clear the cart session
        session()->forget('basket');
        return redirect()->back()->with('success', 'Basket emptied successfully.');
    }

    public function remove(Request $request){
        $stripeId = $request->input('stripe_id');
        // Retrieve the cart from the session
        $basket = session()->get('basket', []);
        // Find the index of the product in the cart
        $productIndex = null;
        foreach ($basket as $index => $basketItem) {
            if ($basketItem['product']->stripe_id === $stripeId) {
                $productIndex = $index;
                break;
            }
        }

        // Check if the product exists in the cart
        if ($productIndex !== null) {
            // Remove the product from the cart
            array_splice($basket, $productIndex, 1);
            // Update the cart in the session
            session()->put('basket', $basket);
            return redirect()->back()->with('success', 'Product.php removed from basket.');
        }
        return redirect()->back()->with('error', 'Product.php not found in basket.');
    }

    public function processPayment(Request $request)
    {
        try {
            // Set the Stripe API key
            Stripe::setApiKey(config('services.stripe.secret'));

            $basketItems = session()->get('basket', []);
            $lineItems = [];
            foreach ($basketItems as $productId => $basketItem) {
                // Retrieve the product from the database
                $product = $basketItem['product'];

                $defaultPrice = $product->default_price;

                // Build the line item data for the Stripe Checkout session
                $lineItems[] = [
                    'price' => $defaultPrice,
                    'quantity' => $basketItem['quantity'],
                ];
            }

            // Create a Stripe Checkout session
            $checkout = Checkout::guest()->create($lineItems, [
                'success_url' => route('stripe.success', ['items' => $lineItems]),
                'cancel_url' => route('stripe.cancel'),
            ]);

            // Redirect the user to the Stripe Checkout page
            return redirect($checkout->url);
        } catch (\Exception $e) {
            // Handle any payment errors
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function paymentSuccess(Request $request)
    {
        session()->forget('basket');

        $lineItems = $request->input('items');
        $totalItems = collect($lineItems)->sum('quantity');

        foreach ($lineItems as $lineItem) {
            $priceId = $lineItem['price'];
            $product = Product::where('default_price', $priceId)->first();
            $products[] = [
                'product' => $product,
                'quantity' => $lineItem['quantity'],
            ];
        }

        $basketItems = $products;
        // Calculate the total number of items in the cart
        $totalItems = collect($products)->sum('quantity');

        $basketTotal = 0;
        $totalItems = 0;
        foreach ($basketItems as $productId => $basketItem) {
            if ($basketItem['product']) {
                $totalItems += $basketItem['quantity'];
                $basketTotal += $basketItem['product']->price_value * $basketItem['quantity'];
            }
        }

        return view('basket', [
            'basketItems' => $basketItems,
            'basketType' => 'checkout',
            'totalQuantity' => $totalItems,
            'totalCost' => $basketTotal
        ]);
    }
}
