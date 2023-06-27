<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\InstagramAuthController;
use App\Http\Controllers\ServiceController;

use App\Models\Product;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::group(['middleware' => ['auth', 'role:client,staff']], function () {
    // Routes accessible to users with the "client" role
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('booking')->group(function () {
    Route::get('/', [BookingController::class, 'index'])->name('booking.index');
    Route::get('/step/{step}/', [BookingController::class, 'step'])->name('booking.step');
    Route::delete('/{id}', [BookingController::class, 'remove'])->name('booking.remove');
    Route::post('/step/4', [BookingController::class, 'submitAppointment'])->name('booking.submit-appointment');
    });

    Route::post('/services/add/{service}', [ServiceController::class, 'add'])->name('services.add');
    Route::delete('/services/remove/', [ServiceController::class, 'remove'])->name('services.remove');
    Route::post('/services/clear', [ServiceController::class, 'clearBooking'])->name('services.clear');

});

Route::group(['middleware' => ['auth', 'role:staff']], function () {
    // Routes accessible to users with the "staff" role
    Route::prefix('booking')->group(function () {
        Route::get('/dashboard', [BookingController::class, 'dashboard'])->name('booking.dashboard');

        Route::get('/{appointment}', [BookingController::class, 'show']);
        Route::delete('/delete/{id}', [BookingController::class, 'destroy'])->name('booking.destroy');

    });


    Route::get('/view-services', [ServiceController::class, 'index'])->name('services.index');
    Route::post('/view-services', [ServiceController::class, 'store'])->name('services.store');
    Route::delete('/view-services/delete/{id}', [ServiceController::class, 'destroy'])->name('services.destroy');

    Route::get('instagram-get-auth', [InstagramAuthController::class, 'show']);
    Route::get('instagram-auth-response', [InstagramAuthController::class, 'complete']);

//    Route::prefix('services')->group(function () {
//        Route::get('/', [ServicesController::class, 'create'])->name('services.create');
//        Route::get('/all', [ServicesController::class, 'show'])->name('services.show');
//
//        Route::post('/create', [ServicesController::class, 'store'])->name('services.store');
//        Route::get('/{appointment}', [ServicesController::class, 'show']);
//    });

    Route::get('/users', function () {
        return view('booking/users');
    })->name('users.all');

    Route::delete('/users/confirm_delete/{user}', [ProfileController::class, 'remove'])->name('users.remove');
    Route::delete('/users/delete/{user}', [ProfileController::class, 'delete'])->name('users.delete');
    Route::get('/users/cancel', [ProfileController::class, 'cancel'])->name('users.cancel');
});

Route::get('/privacy', function () {
    return view('privacy');
});

//Route::get('/', function () {
//    return view('welcome');
//});
//
//Route::get('products/', function () {
//    return view('home');
//});
//
Route::get('products/{stripe_id}', function ($slug) {
    $product = Product::where('stripe_id', $slug)->first();

    return view('products', [
        'product' => $product,
    ]);
});

Route::get('/demo', [\App\Http\Controllers\Controller::class, 'index'])->name('demo.index');


Route::post('/basket/add', [BasketController::class, 'addToBasket'])->name('basket.add');
Route::post('/basket/empty', [BasketController::class, 'emptyBasket'])->name('basket.empty');
Route::post('/basket/remove', [BasketController::class, 'remove'])->name('basket.remove');
Route::get('/basket', [BasketController::class, 'viewBasket'])->name('basket.view');
Route::put('/basket/update/', [BasketController::class, 'update'])->name('basket.update');

Route::get('stripe', [BasketController::class, 'stripe']);
Route::post('stripe', [BasketController::class, 'processPayment'])->name('stripe.process');
Route::get('/payment/success', [BasketController::class, 'paymentSuccess'])->name('stripe.success');
Route::get('/payment/cancel', [BasketController::class, 'paymentCancelled'])->name('stripe.cancel');


use App\Http\Controllers\SocialController;

Route::get('auth/facebook', [SocialController::class, 'facebookRedirect']);
Route::get('auth/facebook/callback', [SocialController::class, 'loginWithFacebook']);

require __DIR__.'/auth.php';
