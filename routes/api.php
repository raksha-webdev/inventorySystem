<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API_Controller;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/get_category', [API_Controller::class, 'get_category']);
Route::post('/add_category', [API_Controller::class, 'add_category']);
Route::post('/category_delete', [API_Controller::class, 'category_delete']);
Route::post('/login', [API_Controller::class, 'login']);
Route::post('/add_updateSupplier', [API_Controller::class, 'add_updateSupplier']);
Route::post('/supplier_details', [API_Controller::class, 'supplier_details']);
Route::post('/delete_supplier', [API_Controller::class, 'delete_supplier']);
Route::post('/add_update_customer', [API_Controller::class, 'add_update_customer']);
Route::post('/get_customers', [API_Controller::class, 'get_customers']);
Route::post('/customers_detail', [API_Controller::class, 'customers_detail']);
Route::post('/delete_customer', [API_Controller::class, 'delete_customer']);
// Product
Route::post('/add_update_product', [API_Controller::class, 'add_update_product']);
Route::post('/product_delete', [API_Controller::class, 'product_delete']);
Route::post('/product_details', [API_Controller::class, 'product_details']);
Route::post('/get_products', [API_Controller::class, 'get_products']);
Route::post('/add_purchase', [API_Controller::class, 'add_purchase']);



