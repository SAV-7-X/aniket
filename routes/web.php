<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Livewire Authentication Routes
use App\Livewire\Auth\{Login, Register};
use App\Livewire\{Billing, Dashboard, Profile, Users,Product, Category, Order, 
    Customer, Review, Coupon, User, 
    Report, Setting};

// Livewire Admin Routes
// use App\Livewire\{
    
// };

// =============================
// 🔹 AUTHENTICATION ROUTES
// =============================
Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/billing', Billing::class)->name('billing');
    Route::get('/profile', Profile::class)->name('profile');
    Route::get('/users', Users::class)->name('users');

    // Logout Route
    Route::post('/logout', function () {
        Auth::logout();
        session()->flush();
        return redirect('/login');
    })->name('logout');
});

// =============================
// 🔹 ADMIN DASHBOARD ROUTES
// =============================
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/products', Product::class)->name('products');
    Route::get('/categories', Category::class)->name('categories');
    Route::get('/orders', Order::class)->name('orders');
    Route::get('/customers', Customer::class)->name('customers');
    Route::get('/reviews', Review::class)->name('reviews');
    Route::get('/coupons', Coupon::class)->name('coupons');
    Route::get('/users', Users::class)->name('users');  // Manage admins & customers
    Route::get('/reports', Report::class)->name('reports'); // Sales reports
    Route::get('/settings', Setting::class)->name('settings');
});


Route::fallback(function () {
    return redirect('/login');
});