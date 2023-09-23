<?php

use App\Http\Controllers\GiftController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\RawMaterialController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\UnitController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.index');
    })->name('admin-index');

    Route::get('/page', [UsersController::class, 'index'])->name('admin-page');
    Route::get('/create', [UsersController::class, 'create'])->name('admin-create');
    Route::post('/store', [UsersController::class, 'store'])->name('admin-store');
    Route::get('/edit/{id}', [UsersController::class, 'edit'])->name('admin-edit');
    Route::put('/update/{id}', [UsersController::class, 'update'])->name('admin-update');

    Route::post('/status', [UsersController::class, 'status'])->name('status');

    Route::get('/supplier', [SuppliersController::class, 'index'])->name('supplier');
    Route::get('/supplier/create', [SuppliersController::class, 'create'])->name('supplier.create');
    Route::post('/supplier/store', [SuppliersController::class, 'store'])->name('supplier.store');
    Route::get('/supplier/edit/{id}', [SuppliersController::class, 'edit'])->name('supplier.edit');
    Route::put('/supplier/update/{id}', [SuppliersController::class, 'update'])->name('supplier.update');

    Route::post('/supplier/status', [SuppliersController::class, 'status'])->name('supplier.status');

    Route::get('/gift', [GiftController::class, 'index'])->name('gift');
    Route::get('/gift/create', [GiftController::class, 'create'])->name('gift.create');
    Route::post('/gift/store', [GiftController::class, 'store'])->name('gift.store');
    Route::get('/gift/edit/{id}', [GiftController::class, 'edit'])->name('gift.edit');
    Route::put('/gift/update/{id}', [GiftController::class, 'update'])->name('gift.update');

    Route::post('/gift.status', [GiftController::class, 'status'])->name('gift.status');

    Route::get('/unit', [UnitController::class, 'index'])->name('unit');
    Route::get('/unit/create', [UnitController::class, 'create'])->name('unit.create');
    Route::post('/unit/store', [UnitController::class, 'store'])->name('unit.store');
    Route::get('/unit/edit/{id}', [UnitController::class, 'edit'])->name('unit.edit');
    Route::put('/unit/update/{id}', [UnitController::class, 'update'])->name('unit.update');

    Route::post('/unit/status', [UnitController::class, 'status'])->name('unit.status');

    Route::get('/raw-material', [RawMaterialController::class, 'index'])->name('raw-material');
    Route::get('/raw-material/create', [RawMaterialController::class, 'create'])->name('raw-material.create');
    Route::post('/raw-material/store', [RawMaterialController::class, 'store'])->name('raw-material.store');
    Route::get('/raw-material/edit/{id}', [RawMaterialController::class, 'edit'])->name('raw-material.edit');
    Route::put('/raw-material/update/{id}', [RawMaterialController::class, 'update'])->name('raw-material.update');

    Route::post('/raw-material/status', [RawMaterialController::class, 'status'])->name('raw-material.status');

    Route::resource('product', ProductController::class);
    Route::post('/product/fetch-raw-materials', [ProductController::class, 'rawMaterials'])->name('product.raw-materials');
    Route::post('/product/status', [ProductController::class, 'status'])->name('product.status');
    Route::get('/purchase',[PurchaseController::class,'index'])->name('purchase');
    Route::get('/purchase/material',[PurchaseController::class,'material'])->name('purchase-material');
    Route::post('/purchase/store', [PurchaseController::class, 'materialStore'])->name('purchase.materialStore');


    Route::get('/signin', function () {
        return view('admin.signin');
    })->name('signin');

    Route::get('/signup', function () {
        return view('admin.signup');
    })->name('signup');

    Route::get('/table', function () {
        return view('admin.tables');
    })->name('table');
});



// Route::get('/gift', function () {
//     return view('admin.gift');
// })->name('gift');




Route::get('/home', [HomeController::class, 'index'])->name('home');
