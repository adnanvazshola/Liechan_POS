<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KasirController;
use App\Http\Livewire\Product;
use App\Http\Livewire\Product\Edit as ProductEdit;
use App\Http\Livewire\Product\Create as ProductCreate;
use App\Http\Livewire\Order;
use App\Http\Livewire\Category;
use App\Http\Livewire\Employee;
use App\Http\Livewire\Transaction;
use App\Http\Livewire\Transaction\Create as TransactionCreate;
use App\Http\Livewire\Transaction\Edit as TransactionEdit;
use App\Http\Livewire\Reservation;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::middleware(['auth'])->group(function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::middleware(['admin'])->group(function () {
        Route::get('admin', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('/employee', [Employee::class,'__invoke'])->name('employee.index');
        //Transaction
        Route::get('/transaction', [Transaction::class,'__invoke'])->name('transaction.index');
        Route::get('/transaction/create', [TransactionCreate::class,'__invoke'])->name('transaction.create');
        Route::get('/transaction/edit/{id}', [TransactionEdit::class,'__invoke'])->name('transaction.edit');
    });
 
    Route::middleware(['kasir'])->group(function () {
        Route::get('kasir', [KasirController::class, 'index'])->name('kasir.dashboard');
    });
 
    Route::get('/products', [Product::class,'__invoke'])->name('products.index');
    Route::get('/product/create', [ProductCreate::class, '__invoke'])->name('product.create');
    Route::get('/product/edit/{id}', [ProductEdit::class, '__invoke'])->name('product.edit');

    Route::get('/point-of-sales', [Order::class,'__invoke'])->name('orders.index');

    Route::get('/categories', [Category::class,'__invoke'])->name('category.index');

    Route::get('/reservation', [Reservation::class,'__invoke'])->name('reservation.index');
    
    Route::get('/logout', function() {
        Auth::logout();
        return redirect('/');
    });
});
