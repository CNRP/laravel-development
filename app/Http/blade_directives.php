<?php
use Illuminate\Support\Facades\Blade;

Blade::directive('productInBasket', function ($stripeId) {
    return "<?php echo session('cart', [])[$stripeId] ? true : false; ?>";
});
