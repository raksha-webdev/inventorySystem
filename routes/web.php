<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;


Route::middleware(['admin.auth'])->group(function () {

Route::get('/',[AdminController::class, 'dashboard']);
Route::get('categorydata/{id?}',[AdminController::class, 'categorydata']);
Route::post('AddCategory/{cat_id?}',[AdminController::class, 'add_category']);
Route::post('category_delete/{cat_id}',[AdminController::class, 'category_delete']);
Route::get('sub_categorydata/{sub_id?}',[AdminController::class, 'sub_categorydata']);
Route::post('add_subcategory/{sub_id?}',[AdminController::class, 'add_subcategory']);
Route::get('subcategory_delete/{sub_id?}',[AdminController::class, 'subcategory_delete']);
// Brand Master

Route::post('add_updatebrand/{brand_id?}',[AdminController::class, 'add_updatebrand']);

Route::get('brand_delete/{brand_id}',[AdminController::class, 'brand_delete']);

// Supplier Master
Route::get('supplierList/{supplier_id?}',[AdminController::class, 'supplierList'])->name('supplierList');
Route::post('add_updateSupplier/{supplier_id?}',[AdminController::class, 'add_updateSupplier'])->name('add_updateSupplier');
Route::get('delete_supplier/{supplier_id}',[AdminController::class, 'delete_supplier'])->name('delete_supplier');
Route::get('supplier_detail/{supplier_id}',[AdminController::class, 'supplier_detail'])->name('supplier_detail');

// Product route starts
Route::get('get_products/{product_id?}',[AdminController::class, 'get_products'])->name('get_products');

Route::get('searchproduct/',[AdminController::class, 'searchproduct'])->name('searchproduct');
Route::get('stock_list/',[AdminController::class, 'stock_list'])->name('stock_list');
Route::post('add_stock/',[AdminController::class, 'add_stock'])->name('add_stock');

Route::post('add_update_product/{product_id?}',[AdminController::class, 'add_update_product'])->name('add_update_product');
Route::get('delete-record/{tableName}/{columnName}/{value}', [AdminController::class,'deleteRecord']);

// Purchase
Route::get('get_purchases/{purchase_id?}', [AdminController::class, 'get_purchases'])
    ->name('get_purchases');

Route::post('add_update_purchase/{purchase_id?}', [AdminController::class, 'add_update_purchase'])
    ->name('add_update_purchase');

Route::get('purchase_invoice/{purchase_id?}', [AdminController::class, 'purchase_invoice'])
    ->name('purchase_invoice');
// Sales pos
// Route::get('sales/', [AdminController::class, 'sales'])->name('sales');

Route::post('add_update_sale/{id?}', [AdminController::class, 'add_update_sale'])->name('add_update_sale');
Route::get('get_sales/{id?}', [AdminController::class, 'get_sales'])->name('get_sales');
Route::get('delete_sale/{id}', [AdminController::class, 'delete_sale'])->name('delete_sale');
Route::get('sale_invoice/{id}', [AdminController::class, 'sale_invoice'])->name('sale_invoice');

 
Route::post('add_update_purchase/{purchase_id?}', [AdminController::class, 'add_update_purchase'])
->name('add_update_purchase');
// Customers
Route::get('get_customer/{id?}', [AdminController::class, 'get_customer'])
->name('get_customer');
Route::post('add_update_customer/{id?}', [AdminController::class, 'add_update_customer'])
->name('add_update_customer');

Route::get('get_customer_sales/{id?}',[AdminController::class,'get_customer_sales'])->name('get_customer_sales');


Route::get('sale_refunds',[AdminController::class,'sale_refunds'])->name('sale_refunds');
Route::post('cancel_sale/{table}/{sale_id}',[AdminController::class,'cancel_sale'])->name('cancel_sale');

Route::get('logout',[AdminController::class, 'logout'])->name('logout');
});
Route::post('logged_in',[AdminController::class, 'logged_in'])->name('logged_in');
Route::get('admin_login',[AdminController::class, 'admin_login'])->name('admin_login');
Route::get('branddata/',[AdminController::class, 'branddata']);

// Route::post('/get_category', [API_Controller::class, 'get_category']);
// Route::post('/add_category', [API_Controller::class, 'add_category']);
// Route::post('/category_delete', [API_Controller::class, 'category_delete']);
// Route::post('/login', [API_Controller::class, 'login']);
// Route::post('/add_updateSupplier', [API_Controller::class, 'add_updateSupplier']);
// Route::post('/supplier_details', [API_Controller::class, 'supplier_details']);
// Route::post('/delete_supplier', [API_Controller::class, 'delete_supplier']);
// Route::post('/add_update_customer', [API_Controller::class, 'add_update_customer']);
// Route::post('/get_customers', [API_Controller::class, 'get_customers']);
// Route::post('/customers_detail', [API_Controller::class, 'customers_detail']);
// Route::post('/delete_customer', [API_Controller::class, 'delete_customer']);