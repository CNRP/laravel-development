<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'stripe_id',
        'name',
        'image_url',
        'description',
        'default_price',
        'price_value',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public static function fetchFromStripe(){

        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        $products = [];
        foreach ($stripe->products->all()->data as $stripeProduct) {
            $price_value = number_format($stripe->prices->retrieve($stripeProduct->default_price)["unit_amount"] / 100,2,".","");
            $product = new Product();
            $product->stripe_id = $stripeProduct->id;
            $product->name = $stripeProduct->name;
            $product->image_url = $stripeProduct->images[0] ?? null;
            $product->description = $stripeProduct->description;
            $product->default_price = $stripeProduct->default_price;
            $product->price_value = $price_value;

            $product->save();
            $products[] = $product;
        }

        return $products;
    }

    public $timestamps = true;
}
