<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\GoogleController;

Route::get('/', [ProductController::class, 'home'])->name('home');
Route::get('/catalog', [ProductController::class, 'index'])->name('catalog');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');
Route::post('/contact/send', function() {
    return redirect()->back()->with('success', 'Дякуємо! Ваше повідомлення отримано.');
})->name('contact.send');

Route::get('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add.to.cart');
Route::get('/cart', [CartController::class, 'cart'])->name('cart.index');
Route::get('/remove-from-cart/{id}', [CartController::class, 'removeFromCart'])->name('remove.from.cart');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

Route::post('/product/{id}/review', [ReviewController::class, 'store'])->name('review.store')->middleware('auth');


Route::middleware(['auth', App\Http\Middleware\AdminMiddleware::class])->group(function () {
    
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/products', [AdminController::class, 'products'])->name('admin.products');
    Route::get('/admin/products/create', [AdminController::class, 'createProduct'])->name('admin.product.create');
    Route::post('/admin/products/store', [AdminController::class, 'storeProduct'])->name('admin.product.store');
    Route::get('/admin/products/edit/{id}', [AdminController::class, 'editProduct'])->name('admin.product.edit');
    Route::post('/admin/products/update/{id}', [AdminController::class, 'updateProduct'])->name('admin.product.update');
    Route::get('/admin/products/delete/{id}', [AdminController::class, 'deleteProduct'])->name('admin.product.delete');

    Route::get('/admin/products/{id}/specifications', [AdminController::class, 'productSpecifications'])->name('admin.product.specifications');
    Route::post('/admin/products/{id}/specifications', [AdminController::class, 'addSpecification'])->name('admin.product.add_specification');
    Route::get('/admin/specifications/delete/{spec_id}', [AdminController::class, 'deleteSpecification'])->name('admin.specification.delete');

    Route::get('/admin/orders', [AdminController::class, 'orders'])->name('admin.orders');
    Route::get('/admin/orders/{id}', [AdminController::class, 'showOrder'])->name('admin.order.show');
    Route::post('/admin/orders/{id}/status', [AdminController::class, 'updateOrderStatus'])->name('admin.order.updateStatus');
    Route::get('/admin/orders/delete/{id}', [AdminController::class, 'deleteOrder'])->name('admin.order.delete');

    Route::get('/admin/customers', [AdminController::class, 'customers'])->name('admin.customers');
    Route::get('/admin/customers/delete/{id}', [AdminController::class, 'deleteCustomer'])->name('admin.customer.delete');
    Route::get('/admin/customers/toggle-admin/{id}', [AdminController::class, 'toggleAdmin'])->name('admin.customer.toggle');

    Route::get('/admin/reviews', [AdminController::class, 'reviews'])->name('admin.reviews.index');
    Route::delete('/admin/reviews/{id}', [AdminController::class, 'deleteReview'])->name('admin.reviews.destroy');
});