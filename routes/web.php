<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/products');
});

Route::resource('products', ProductController::class);
Route::resource('orders', OrderController::class);

// Маршрут для изменения статуса заказа
Route::post('orders/{order}/mark-as-completed', [OrderController::class, 'markAsCompleted'])->name('orders.markAsCompleted');
