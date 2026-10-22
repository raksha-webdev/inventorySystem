<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use App\Models\brandmaster;
use App\Models\customer;
use App\Models\product;
use App\Models\purchase;
use App\Models\purchase_items;
use App\Models\sale_refunds;
use App\Models\SalesMaster;
use App\Models\SalesProductListMaster;
use App\Models\stock_log_master;
use App\Models\subcategory;
use App\Models\supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\category;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
  
    public function deleteRecord($tableName, $columnName, $value)
{
    return commonDelete($tableName, $columnName, $value);
}

    public function dashboard(){
        $catgory_count = Category::count();
        $sub_category_count = subcategory::count();
        $supplier = supplier::count();
        $product = product::count();
        $user = User::count();
        return view('index',compact('catgory_count','sub_category_count','user','product','supplier'));
    }

    public function categorydata($id = null)
    {
        $cat_data = Category::all(); // or however you're fetching the list
    
        return view('categoryList', compact('id', 'cat_data'));
    }

// =====================================================
    // GET CATEGORY
    // =====================================================

 


    // =====================================================
    // ADD / UPDATE CATEGORY
    // =====================================================

    public function add_category(Request $request, $cat_id = null)
    {
        // Check what Laravel is receiving
        // dd($cat_id);
    
        $request->validate([
            'cat_name' => 'required|string|max:255',
    
            'cat_img' =>  'nullable',
    
            'status' => 'required|in:0,1',
        ]);
    
        if ($cat_id) {
    
            $category = Category::find($cat_id);
    
            if (!$category) {
                return redirect()->back()
                    ->with('error', 'Category not found');
            }
    
            $cat_img = $category->cat_img;
    
            if ($request->hasFile('cat_img')) {
    
                $cat_img = saveImgFile(
                    $request->file('cat_img'),
                    'assests_uploads/category_img/'
                );
    
                if ($category->cat_img) {
    
                    $oldImage = public_path(
                        'assests_uploads/category_img/' . $category->cat_img
                    );
    
                    if (file_exists($oldImage)) {
                        unlink($oldImage);
                    }
                }
            }
    
            $category->update([
                'cat_name' => $request->cat_name,
                'cat_img'  => $cat_img,
                'status'   => $request->status,
            ]);
    
            return redirect('categorydata')
                ->with('success', 'Category Updated Successfully');
        }
    
        // ADD
        $cat_img = saveImgFile(
            $request->file('cat_img'),
            'assests_uploads/category_img/'
        );
    
        Category::create([
            'cat_name' => $request->cat_name,
            'cat_img'  => $cat_img,
            'status'   => $request->status,
        ]);
    
        return redirect('categorydata')
            ->with('success', 'Category Added Successfully');
    }


    // =====================================================
    // DELETE CATEGORY
    // =====================================================

    public function category_delete(Request $request,$cat_id)
    {
       

        $cat_all_data = Category::where(
            'id',
            $cat_id
        )->first();


        // Category not found
        if (!$cat_all_data) {
            return redirect()->back()
                ->with('error', 'Category not found');
        }


        // Delete image
        if ($cat_all_data->cat_img) {

            $oldImage = public_path(
                'assests/category_img/' . $cat_all_data->cat_img
            );

            if (file_exists($oldImage)) {
                unlink($oldImage);
            }
        }


        // Delete category
        $cat_all_data->delete();
        return redirect('categorydata/')
            ->with('success', 'Category Deleted Successfully');
    }


     public function sub_categorydata($sub_id = null){
        $cat_data = Category::where('status', 1)->get();

$sub_cat_data = DB::table('sub_category')
    ->join('category', 'category.id', '=', 'sub_category.cat_id')
    ->select(
        'sub_category.*',
        'category.cat_name'
    )
    ->get();

return view('subcategoryList', compact(
    'cat_data',
    'sub_cat_data'
));
     }



     public function add_subcategory(Request $request, $id = null)
{
    // Validation
    $request->validate([
        'cat_id' => 'required|exists:category,id',
        'name' => 'required|string|max:255',
        'status' => 'required|in:0,1',
    ], [
        'cat_id.required' => 'Please select category.',
        'cat_id.exists' => 'Selected category is invalid.',
        'name.required' => 'Please enter sub category name.',
        'status.required' => 'Please select status.',
    ]);


    // =========================
    // UPDATE SUB CATEGORY
    // =========================
    if ($id) {

        $sub_category = subcategory::find($id);

        if (!$sub_category) {
            return redirect()->back()
                ->with('error', 'Sub Category not found.');
        }

        $sub_category->update([
            'cat_id' => $request->cat_id,
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return redirect('sub_categorydata')
            ->with('success', 'Sub Category Updated Successfully.');
    }


    // =========================
    // ADD SUB CATEGORY
    // =========================

    subcategory::create([
        'cat_id' => $request->cat_id,
        'name' => $request->name,
        'status' => $request->status,
        'added_date_time' => now(),
    ]);

    return redirect('sub_categorydata')
        ->with('success', 'Sub Category Added Successfully.');
}


public function subcategory_delete(Request $request,$sub_cat_id)
{
    $cat_all_data = subcategory::where(
        'id',
        $sub_cat_id
    )->first();


    // Category not found
    if (!$cat_all_data) {
        return redirect()->back()
            ->with('error', 'Category not found');
    }


    

    // Delete category
    $cat_all_data->delete();
    return redirect('sub_categorydata/')
        ->with('success', 'Sub Category Deleted Successfully');
}



public function branddata($brand_id = null){
    $brand_data = DB::table('brand_master')->get();
    return view('brandmasterList', compact('brand_data'));
}


public function add_updatebrand(Request $request, $brand_id = null){ 
    date_default_timezone_set('Asia/Kolkata');
    $ctime = date('Y-m-d H:i:s');

       // Validation
    $request->validate([
        'name' => 'required|string|max:255',
        'status' => 'required|in:0,1',
    ]);


    // =========================
    // UPDATE  brand
    // =========================
    if ($brand_id) {

        $brandmaster = brandmaster::find($brand_id);

        if (!$brandmaster) {
            return redirect()->back()
                ->with('error', 'Brand not found.');
        }

        $brandmaster->update([
            'name' => $request->name,
            'status' => $request->status,
            'added_date_time' => $ctime,
        ]);

        return redirect('branddata')
            ->with('success', 'Brand Updated Successfully.');
    }


    // =========================
    // ADD SUB CATEGORY
    // =========================

    brandmaster::create([
        'name' => $request->name,
        'status' => $request->status,
        'added_date_time' => $ctime,
    ]);

    return redirect('branddata')
        ->with('success', 'Brand  Added Successfully.');



}





public function brand_delete(Request $request,$brand_id)
{
    $brand_data = brandmaster::where(
        'id',
        $brand_id
    )->first();

    // brand not found
    if (!$brand_data) {
        return redirect()->back()
            ->with('error', 'Brand not found');
    }
    $brand_data->delete();
    return redirect('branddata/')
        ->with('success', 'Brand Deleted Successfully');
}




// Supplier 
// ================= SUPPLIER LIST =================

public function supplierList($id = null)
{
    // Get all suppliers
    $suppliers = DB::table('suppliers')
        ->orderBy('id', 'desc')
        ->get();

    // Default value
    $supplier_data = null;

    // If ID is provided
    if ($id != null) {

        $supplier_data = DB::table('suppliers')
            ->where('id', $id)
            ->first();

        if (!$supplier_data) {
            return redirect()
                ->route('supplierList')
                ->with('error', 'Supplier not found.');
        }
    }

    // Send BOTH variables
    return view('supplierList', compact('suppliers', 'supplier_data'));
}


// ================= ADD + UPDATE SUPPLIER =================

public function add_updateSupplier(Request $request,$supplier_id = null)
{
    $validator = Validator::make($request->all(), [

        'supplier_name' => 'required',
        'email' => 'required|email',
        'contact_person' => 'nullable',
        'phone' => 'required',
        'address' => 'required',
        'city' => 'required',
        'state' => 'required',
        'pin_code' => 'required',
        'status' => 'required|boolean',

        'alternate_phone' => 'nullable',
        'website' => 'nullable',
        'notes' => 'nullable',
        'gst_number' => 'nullable',

    ]);

    if ($validator->fails()) {

        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }


    // ================= UPDATE =================

    if ($supplier_id) {
        $supplier_data = Supplier::where(
            'id',
            $supplier_id
        )->first();

        if (!$supplier_data) {
            return redirect()->back()
                ->with('error', 'Supplier Not Found');
        }


        $supplier_data->update([

            'supplier_name' => $request->supplier_name,
            'email' => $request->email,
            'contact_person' => $request->contact_person,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'pin_code' => $request->pin_code,
            'status' => $request->status,

            'alternate_phone' => $request->alternate_phone ?? '',
            'website' => $request->website ?? '',
            'notes' => $request->notes ?? '',
            'gst_number' => $request->gst_number ?? '',

        ]);


        return redirect()->route('supplierList')
            ->with('success', 'Supplier Updated Successfully');
    }


    // ================= ADD =================

    $supplier_code = 'Supplier_code'
        . date('Ymd')
        . rand(1000, 9999);


        supplier::create([

        'supplier_name' => $request->supplier_name,
        'email' => $request->email,
        'contact_person' => $request->contact_person,
        'phone' => $request->phone,
        'address' => $request->address,
        'city' => $request->city,
        'state' => $request->state,
        'pin_code' => $request->pin_code,

        'supplier_code' => $supplier_code,

        'status' => $request->status,

        'alternate_phone' => $request->alternate_phone ?? '',
        'website' => $request->website ?? '',
        'notes' => $request->notes ?? '',
        'gst_number' => $request->gst_number ?? '',

    ]);


    return redirect()->route('supplierList')
        ->with('success', 'Supplier Added Successfully');
}


// ================= DELETE SUPPLIER =================

public function delete_supplier($id)
{
    $supplier_data = supplier::where('id', $id)->first();

    if (!$supplier_data) {

        return redirect()->back()
            ->with('error', 'Supplier Not Found');
    }


    $supplier_data->delete();


    return redirect()->route('supplierList')
        ->with('success', 'Supplier Deleted Successfully');
}


// ================= SUPPLIER DETAILS =================

public function supplier_detail($id)
{
    $supplier_data = supplier::where('id', $id)->first();

    if (!$supplier_data) {

        return redirect()->back()
            ->with('error', 'Supplier Not Found');
    }
    return view('supplier_detail', compact('supplier_data'));
}



// Product 
// public function get_products($id = null)
// {
//     $product_data = product::with('category','supplier','brand')
//         ->orderBy('id', 'desc')
//         ->get();

//     $cat_data = category::where('status', 1)->get();
//     // dd($cat_data);

//     $supplier_data = supplier::where('status', 1)->get();
//     $brand_data = brandmaster::where('status', 1)->get();

//     $product_data_single = null;

//     if ($id) {
//         $product_data_single = product::where('id', $id)->first();
//     }

//     return view('productList', compact(
//         'product_data',
//         'supplier_data',
//         'cat_data',
//         'product_data_single',
//         'id',
//         'brand_data',
//     ));
// }




public function add_update_product(Request $request, $product_id = null)
{
    // =========================
    // UPDATE PRODUCT
    // =========================

    if ($product_id) {

        $product_data = Product::where('id', $product_id)->first();

        if (!$product_data) {

            return redirect()
                ->route('get_products')
                ->with('error', 'Product Not Found');
        }

        // Validation
        $request->validate([
            'product_name' => 'required',
            'category_id' => 'required',
            'supplier_id' => 'required',
            'brand_id' => 'required',
            'sku' => 'required|unique:product,sku,' . $product_id,
            'barcode' => 'nullable|unique:product,barcode,' . $product_id,
            'description' => 'nullable',
            'purchase_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'minimum_stock' => 'required|integer',
            'unit' => 'required',
            'status' => 'required|boolean',
            'product_image' => 'nullable|image',
        ]);


        // Existing image
        $product_image = $product_data->product_image;


        // If new image is uploaded
        if ($request->hasFile('product_image')) {

            // Save new image
            $product_image = saveImgFile(
                $request->file('product_image'),
                'assests_uploads/product_image/'
            );


            // Delete old image
            if ($product_data->product_image) {

                $oldImage = public_path(
                    'assests_uploads/product_image/' . $product_data->product_image
                );

                if (file_exists($oldImage)) {
                    unlink($oldImage);
                }
            }
        }


        // Update product
        $product_data->update([

            'product_name' => $request->product_name ?? '',
            'category_id' => $request->category_id ?? '',
            'supplier_id' => $request->supplier_id ?? '',
            'brand_id' => $request->brand_id ?? '',
            'sku' => $request->sku ?? '',
            'barcode' => $request->barcode ?? '',
            'description' => $request->description ?? '',
            'purchase_price' => $request->purchase_price ?? '',
            'selling_price' => $request->selling_price ?? '',
            'stock_quantity' => $request->stock_quantity ?? '',
            'minimum_stock' => $request->minimum_stock ?? '',
            'unit' => $request->unit ?? '',
            'status' => $request->status ?? '',
            'product_image' => $product_image,

        ]);


        return redirect()
            ->route('get_products')
            ->with('success', 'Product Updated Successfully');
    }


    // =========================
    // ADD PRODUCT
    // =========================

    $request->validate([

        'product_name' => 'required',
        'category_id' => 'required',
        'supplier_id' => 'required',
        'brand_id' => 'required',
        'sku' => 'required|unique:product,sku',
        'barcode' => 'nullable|unique:product,barcode',
        'description' => 'nullable',
        'purchase_price' => 'required|numeric',
        'selling_price' => 'required|numeric',
        'stock_quantity' => 'required|integer',
        'minimum_stock' => 'required|integer',
        'unit' => 'required',
        'status' => 'required|boolean',
        'product_image' => 'nullable|image',

    ]);


    // Default image value
    $product_image = null;


    // If image is uploaded
    if ($request->hasFile('product_image')) {

        $product_image = saveImgFile(
            $request->file('product_image'),
            'assests_uploads/product_image/'
        );
    }


    // Create product
    Product::create([

        'product_name' => $request->product_name ??'',
        'category_id' => $request->category_id ??'',
        'supplier_id' => $request->supplier_id ??'',
        'brand_id' => $request->brand_id ??'',
        'sku' => $request->sku ??'',
        'barcode' => $request->barcode ??'',
        'description' => $request->description ?? '',
        'purchase_price' => $request->purchase_price ??'',
        'selling_price' => $request->selling_price ??'',
        'stock_quantity' => $request->stock_quantity ??'',
        'minimum_stock' => $request->minimum_stock ??'',
        'unit' => $request->unit ??'',
        'status' => $request->status ??'',
        'product_image' => $product_image,

    ]);


    return redirect()
        ->route('get_products')
        ->with('success', 'Product Added Successfully');
}



public function get_purchases($purchase_id = null)
{
    // Get all purchases
    $purchase_data = purchase::with('supplier', 'items.product')
        ->where('is_deleted', '0')
        ->orderBy('id', 'desc')
        ->get();

    // Get suppliers for dropdown
    $supplier_data = supplier::where('status', 1)
        ->get();

    // Get products for dropdown
    $product_data = Product::where('status', 1)
        ->get();

    // For edit
    $purchase_data_single = null;

    if ($purchase_id) {

        $purchase_data_single = Purchase::with('items')
            ->where('id', $purchase_id)
            ->where('is_deleted', '0')
            ->first();

        if (!$purchase_data_single) {

            return redirect()
                ->route('get_purchases')
                ->with('error', 'Purchase Not Found');
        }
    }

    return view('purchaseList', compact(
        'purchase_data',
        'supplier_data',
        'product_data',
        'purchase_data_single',
        'purchase_id'
    ));
}



public function add_update_purchase(Request $request, $purchase_id = null)
{
    // ==============================
    // UPDATE
    // ==============================

    if ($purchase_id) {

        $purchase = Purchase::where('id', $purchase_id)
            ->where('is_deleted', '0')
            ->first();

        if (!$purchase) {

            return redirect()
                ->route('get_purchases')
                ->with('error', 'Purchase Not Found');
        }


        // Validation

        $request->validate([

            'supplier_id' => 'required|exists:suppliers,id',

            'invoice_number' => 'required',

            'purchase_date' => 'required|date',

            'tax_percent' => 'required|numeric|min:0',

            'discount' => 'required|numeric|min:0',

            'shipping_charge' => 'required|numeric|min:0',

            'paid_amount' => 'required|numeric|min:0',

            'payment_method' =>
                'required|in:Cash,Card,UPI,Bank Transfer',

            'payment_status' =>
                'required|in:Paid,Partial,Pending',

            'remarks' => 'nullable',

            'products' => 'required|array|min:1',

            'products.*.product_id' =>
                'required|exists:product,id',

            'products.*.quantity' =>
                'required|integer|min:1',

            'products.*.purchase_price' =>
                'required|numeric|min:0',
        ]);


        DB::beginTransaction();

        try {

            // =====================================
            // Calculate New Subtotal
            // =====================================

            $subtotal = 0;

            foreach ($request->products as $item) {

                $subtotal +=
                    $item['quantity'] *
                    $item['purchase_price'];
            }


            // =====================================
            // Calculate Tax
            // =====================================

            $taxAmount =
                ($subtotal * $request->tax_percent) / 100;


            // =====================================
            // Calculate Grand Total
            // =====================================

            $grandTotal =
                $subtotal +
                $taxAmount +
                $request->shipping_charge -
                $request->discount;


            if ($grandTotal < 0) {

                $grandTotal = 0;
            }


            // =====================================
            // Calculate Due
            // =====================================

            $dueAmount =
                $grandTotal -
                $request->paid_amount;


            if ($dueAmount < 0) {

                $dueAmount = 0;
            }


            // =====================================
            // Old Purchase Items
            // =====================================

            $oldItems = purchase_items::where(
                'purchase_id',
                $purchase->id
            )->get();


            // =====================================
            // Remove Old Stock
            // =====================================

            foreach ($oldItems as $oldItem) {

                $oldProduct =
                    Product::find($oldItem->product_id);

                if ($oldProduct) {

                    $oldProduct->decrement(
                        'stock_quantity',
                        $oldItem->quantity
                    );
                }
            }


            // =====================================
            // Delete Old Items
            // =====================================

            purchase_items::where(
                'purchase_id',
                $purchase->id
            )->delete();


            // =====================================
            // Update Purchase
            // =====================================

            $purchase->update([
                'supplier_id' =>
                    $request->supplier_id,

                'invoice_number' =>
                    $request->invoice_number,

                'purchase_date' =>
                    $request->purchase_date,

                'subtotal' =>
                    $subtotal,

                'tax_percent' =>
                    $request->tax_percent,

                'tax_amount' =>
                    $taxAmount,

                'discount' =>
                    $request->discount,

                'shipping_charge' =>
                    $request->shipping_charge,

                'grand_total' =>
                    $grandTotal,

                'paid_amount' =>
                    $request->paid_amount,

                'due_amount' =>
                    $dueAmount,

                'payment_method' =>
                    $request->payment_method,

                'payment_status' =>
                    $request->payment_status,

                'remarks' =>
                    $request->remarks,
            ]);


            // =====================================
            // Save New Items + Increase Stock
            // =====================================

            foreach ($request->products as $item) {

                purchase_items::create([

                    'purchase_id' =>
                        $purchase->id,

                    'product_id' =>
                        $item['product_id'],

                    'quantity' =>
                        $item['quantity'],

                    'purchase_price' =>
                        $item['purchase_price'],

                    'subtotal' =>
                        $item['quantity'] *
                        $item['purchase_price'],
                ]);


                // Increase New Stock

                $product =
                    Product::findOrFail(
                        $item['product_id']
                    );

                $product->increment(
                    'stock_quantity',
                    $item['quantity']
                );
            }


            DB::commit();


            return redirect()
                ->route('get_purchases')
                ->with(
                    'success',
                    'Purchase Updated Successfully'
                );

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    $e->getMessage()
                );
        }
    }


    // ==============================
    // ADD
    // ==============================

    $request->validate([

        'supplier_id' =>
            'required|exists:suppliers,id',

        'invoice_number' =>
            'nullable',

        'purchase_date' =>
            'required|date',

        'tax_percent' =>
            'required|numeric|min:0',

        'discount' =>
            'required|numeric|min:0',

        'shipping_charge' =>
            'required|numeric|min:0',

        'paid_amount' =>
            'required|numeric|min:0',

        'payment_method' =>
            'required|in:Cash,Card,UPI,Bank Transfer',

        'payment_status' =>
            'required|in:Paid,Partial,Pending',

        'remarks' =>
            'nullable',

        'products' =>
            'required|array|min:1',

        'products.*.product_id' =>
            'required|exists:product,id',

        'products.*.quantity' =>
            'required|integer|min:1',

        'products.*.purchase_price' =>
            'required|numeric|min:0',
    ]);


    DB::beginTransaction();

    try {

        // =====================================
        // Generate Invoice Number
        // =====================================

        $lastPurchase =
            Purchase::latest('id')->first();

        $number =
            $lastPurchase
                ? $lastPurchase->id + 1
                : 1;

        $invoiceNumber =
            'PUR-' .
            str_pad(
                $number,
                6,
                '0',
                STR_PAD_LEFT
            );


        // =====================================
        // Calculate Subtotal
        // =====================================

        $subtotal = 0;

        foreach ($request->products as $item) {

            $subtotal +=
                $item['quantity'] *
                $item['purchase_price'];
        }


        // =====================================
        // Tax
        // =====================================

        $taxAmount =
            ($subtotal * $request->tax_percent) / 100;


        // =====================================
        // Grand Total
        // =====================================

        $grandTotal =
            $subtotal +
            $taxAmount +
            $request->shipping_charge -
            $request->discount;


        if ($grandTotal < 0) {

            $grandTotal = 0;
        }


        // =====================================
        // Due
        // =====================================

        $dueAmount =
            $grandTotal -
            $request->paid_amount;


        if ($dueAmount < 0) {

            $dueAmount = 0;
        }


        // =====================================
        // Save Purchase
        // =====================================

        $purchase = Purchase::create([

            'supplier_id' =>
                $request->supplier_id,

            'invoice_number' =>
                $invoiceNumber,

            'purchase_date' =>
                $request->purchase_date,

            'subtotal' =>
                $subtotal,

            'tax_percent' =>
                $request->tax_percent,

            'tax_amount' =>
                $taxAmount,

            'discount' =>
                $request->discount,

            'shipping_charge' =>
                $request->shipping_charge,

            'grand_total' =>
                $grandTotal,

            'paid_amount' =>
                $request->paid_amount,

            'due_amount' =>
                $dueAmount,

            'payment_method' =>
                $request->payment_method,

            'payment_status' =>
                $request->payment_status,

            'remarks' =>
                $request->remarks,

            'is_deleted' =>
                '0',
        ]);


        // =====================================
        // Save Items + Update Stock
        // =====================================

        foreach ($request->products as $item) {

            purchase_items::create([

                'purchase_id' =>
                    $purchase->id,

                'product_id' =>
                    $item['product_id'],

                'quantity' =>
                    $item['quantity'],

                'purchase_price' =>
                    $item['purchase_price'],

                'subtotal' =>
                    $item['quantity'] *
                    $item['purchase_price'],
            ]);


            // Increase Stock

            $product =
                Product::findOrFail(
                    $item['product_id']
                );

            $product->increment(
                'stock_quantity',
                $item['quantity']
            );
        }


        DB::commit();


        return redirect()
            ->route('get_purchases')
            ->with(
                'success',
                'Purchase Added Successfully'
            );

    } catch (\Exception $e) {

        DB::rollBack();

        return redirect()
            ->back()
            ->withInput()
            ->with(
                'error',
                $e->getMessage()
            );
    }
}



public function admin_login(){
    
        return view('login');
}

//  public function logged_in(Request $request){
          
//     $admin = DB::table('_admin')
//     ->where('email', $request->email)
//     ->first();

// dd([
//     'email' => $request->email,
//     'db_password' => $admin->password ?? 'NOT FOUND',
//     'length' => $admin ? strlen($admin->password) : 0,
//     'first_4' => $admin ? substr($admin->password, 0, 4) : 'NOT FOUND',
//     'hash_check' => $admin
//         ? Hash::check($request->password, $admin->password)
//         : false,
// ]);
//     // dd($request->all());

//         $request->validate([
//             'email' => 'required|email',
//             'password' => 'required',
//         ]);
    
//         // $credentials = [
//         //     'email' => $request->email,
//         //     'password' => $request->password,
//         //     'status' => 'active',
//         // ];
    
    
//         if (Auth::guard('admin')->attempt($credentials)) {

//             $request->session()->regenerate();
    
//             return redirect()->intended('dashboard')->with('success', 'Logged in successfully');
    
//         } else {
    
//             return redirect()->back()
//                 ->withInput($request->only('email'))
//                 ->withErrors([
//                     'email' => 'Invalid email or password.',
//                 ]);
//         }
//     }



public function logged_in(Request $request)
{
    
    $request->validate([
        'mobile_number' => 'required',
        'password' => 'required',
    ]);
    
    $detail = Admin::where('mobile_number', $request->mobile_number)
    ->where('password', $request->password)
    ->where('status', 'active')
    ->first();
    
    if (!$detail) {
        return back()
        ->withInput()
        ->with('error', 'Invalid mobile_number or password.');
    }
    
    session([
        'id' => $detail->id,
        'email' => $detail->email,
        'mobile_number' => $detail->mobile_number,
        'admin_name' => $detail->full_name,
        'admin_type' => $detail->user_type,
    ]);


//     dd(
// [
//         'session_admin_id' => session('admin_id'),
//         'session_email' => session('email'),
//         'session_mobile_number' => session('mobile_number'),
//         'session_admin_name' => session('admin_name'),
//         'session_admin_type' => session('admin_type'),
//         // 'session_password' => session('password'),
//     ]);
  

    return redirect('/')
        ->with('success', 'Logged in successfully');
}



    public function logout(Request $request)
{
    session()->flush();
    return redirect('admin_login');
}


// public function purchase_invoice($purchase_id=''){
//    $purchase_detail= purchase::where('id',$purchase_id)->first();
//    $product_list= purchase_items::where('purchase_id',$purchase_id)->get();  
   
        
//          return view('purchase_invoice', compact('purchase_id','purchase_detail','product_list'));
// } 

public function purchase_invoice($purchase_id = '')
{
    // ==========================================
    // PURCHASE DETAILS
    // ==========================================

    $purchase_detail = purchase::where('id', $purchase_id)
        ->where('is_deleted', '0')
        ->firstOrFail();


    // ==========================================
    // SUPPLIER DETAILS
    // ==========================================

    $supplier_detail = supplier::where(
        'id',
        $purchase_detail->supplier_id
    )->first();


    // ==========================================
    // PURCHASE ITEMS
    // ==========================================

    $product_list = purchase_items::where(
        'purchase_id',
        $purchase_id
    )->get();


    // ==========================================
    // GRAND TOTAL IN WORDS
    // ==========================================

    $grandTotal = (float) $purchase_detail->grand_total;

    $rupees = (int) floor($grandTotal);

    $paise = (int) round(
        ($grandTotal - $rupees) * 100
    );


    $grand_total_words =
        $this->numberToWords($rupees)
        . ' Rupees';


    if ($paise > 0) {

        $grand_total_words .=
            ' and '
            . $this->numberToWords($paise)
            . ' Paise';
    }


    $grand_total_words .= ' Only';


    // ==========================================
    // YOUR BUSINESS DETAILS
    // ==========================================
    //
    // TEMPORARY
    //
    // Later you can move these values to
    // business_settings/company_settings table.
    //

    $business = [

        'name' => 'Smart Inventory ',

        'address' => 'Lucknow Uttar Pradesh',

        'city' => 'Lucknow',

        'state' => 'Uttar Pradesh',

        'pin_code' => '226010',

        'phone' => '1234567891',

        'email' => 'smartinventory@gmail.com',

        'gst_number' => '87945127412',

    ];


    // ==========================================
    // RETURN VIEW
    // ==========================================

    return view(
        'purchase_invoice',
        compact(
            'purchase_id',
            'purchase_detail',
            'supplier_detail',
            'product_list',
            'grand_total_words',
            'business'
        )
    );
}


/*
|--------------------------------------------------------------------------
| NUMBER TO WORDS - INDIAN NUMBER SYSTEM
|--------------------------------------------------------------------------
*/

private function numberToWords($number)
{
    $number = (int) $number;


    $ones = [

        0 => 'Zero',
        1 => 'One',
        2 => 'Two',
        3 => 'Three',
        4 => 'Four',
        5 => 'Five',
        6 => 'Six',
        7 => 'Seven',
        8 => 'Eight',
        9 => 'Nine',
        10 => 'Ten',
        11 => 'Eleven',
        12 => 'Twelve',
        13 => 'Thirteen',
        14 => 'Fourteen',
        15 => 'Fifteen',
        16 => 'Sixteen',
        17 => 'Seventeen',
        18 => 'Eighteen',
        19 => 'Nineteen',

    ];


    $tens = [

        20 => 'Twenty',
        30 => 'Thirty',
        40 => 'Forty',
        50 => 'Fifty',
        60 => 'Sixty',
        70 => 'Seventy',
        80 => 'Eighty',
        90 => 'Ninety',

    ];


    // 0 - 19

    if ($number < 20) {

        return $ones[$number];

    }


    // 20 - 99

    if ($number < 100) {

        return
            $tens[intdiv($number, 10) * 10]
            .
            (
                $number % 10
                ?
                ' ' . $ones[$number % 10]
                :
                ''
            );

    }


    // 100 - 999

    if ($number < 1000) {

        return
            $ones[intdiv($number, 100)]
            . ' Hundred'
            .
            (
                $number % 100
                ?
                ' ' . $this->numberToWords($number % 100)
                :
                ''
            );

    }


    // 1,000 - 99,999

    if ($number < 100000) {

        return
            $this->numberToWords(
                intdiv($number, 1000)
            )
            . ' Thousand'
            .
            (
                $number % 1000
                ?
                ' ' . $this->numberToWords($number % 1000)
                :
                ''
            );

    }


    // 1,00,000 - 99,99,999

    if ($number < 10000000) {

        return
            $this->numberToWords(
                intdiv($number, 100000)
            )
            . ' Lakh'
            .
            (
                $number % 100000
                ?
                ' ' . $this->numberToWords($number % 100000)
                :
                ''
            );

    }


    // Crore

    return
        $this->numberToWords(
            intdiv($number, 10000000)
        )
        . ' Crore'
        .
        (
            $number % 10000000
            ?
            ' ' . $this->numberToWords($number % 10000000)
            :
            ''
        );
}



// public function searchproduct(Request $request){
//     $request->validate([
//         'search_text' => 'required',
//     ]);

//     $search_text=$request->search_text;

//     $product_data = Product::where('product_name', 'LIKE', '%' . $search_text . '%') ->get();
//      if ($product_data->isEmpty())
//      { 
        
//         return redirect()->back()->with('error', 'Product not found'); 
//     }

//      return view('productList', compact('product_data'))->with('success', 'Product found');
// }




public function get_products($id = null)
{
    // Search text
    $search_text = request('search_text');

    // Product query
    $product_query = Product::with([
        'category',
        'supplier',
        'brand'
    ]);

    // Agar search text diya gaya hai
    if ($search_text) {
        $product_query->where(function ($query) use ($search_text) {
    
            $query->where('product_name', 'LIKE', '%' . $search_text . '%')
                  ->orWhere('sku', 'LIKE', '%' . $search_text . '%')
    
                  ->orWhereHas('category', function ($q) use ($search_text) {
                      $q->where('cat_name', 'LIKE', '%' . $search_text . '%');
                  })
    
                  ->orWhereHas('supplier', function ($q) use ($search_text) {
                      $q->where('supplier_name', 'LIKE', '%' . $search_text . '%');
                  });
    
        });
    }

    // Products get
    $product_data = $product_query
        ->orderBy('id', 'desc')
        ->get();

    // Category
    $cat_data = category::where('status', 1)->get();

    // Supplier
    $supplier_data = supplier::where('status', 1)->get();

    // Brand
    $brand_data = brandmaster::where('status', 1)->get();

    // Default
    $product_data_single = null;

    // Edit product
    if ($id) {
        $product_data_single = Product::where('id', $id)->first();
    }

    return view('productList', compact(
        'product_data',
        'supplier_data',
        'cat_data',
        'product_data_single',
        'id',
        'brand_data',
        'search_text'
    ));
}


public function stock_list(){
    $product_data = Product::all();
    $stock_data = stock_log_master::with ('product')->orderBy('id','desc')->get();
    return view('stock_list',compact('product_data','stock_data'));
}


//   public function add_stock(Request $request){
    
//         $request->validate([
//             'product_id' => 'required|exists:product,id',
//             'quantity' => 'required|integer|min:1',
//             'transaction_type' => 'required|in:increase,decrease',
//         ]);
    
//         $product = Product::find($request->product_id);
//         $previous_stock=$product->stock_quantity;
    
//         if ($request->type == 'add'){
//           $new_stock = $product->increment('stock_quantity', $request->quantity);
//         } 
//         else {
//             if ($product->stock_quantity < $request->quantity) {
//                 return redirect()->back()->with('error', 'Not enough stock to remove.');
//             }
//            $new_stock= $product->decrement('stock_quantity', $request->quantity);
//         }
 
//         stock_log_master::create([
//             'product_id' => $request->product_id,
//             'quantity' => $request->quantity,
//             'transaction_type' => $request->transaction_type,
//             'status'=>$request->status,
//             'previous_stock' => $previous_stock,
//             'new_stock'=> $new_stock,
//             'reason'=> $request->reason,
//         ]);
//         return redirect()->back()->with('success', 'Stock added successfully.');
// }






public function add_stock(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:product,id',
        'quantity' => 'required|integer|min:1',
        'transaction_type' => 'required|in:increase,decrease',
        'reason' => 'nullable|string',
    ]);

    $product = Product::find($request->product_id);

    $previous_stock = $product->stock_quantity;

    if ($request->transaction_type == 'increase') {

        $new_stock = $previous_stock + $request->quantity;

        $product->stock_quantity = $new_stock;
        $product->save();
        $message = 'Stock added successfully.';
    } 
    else {
        if ($previous_stock < $request->quantity) {
            return redirect()->back()->with('error', 'Not enough stock to remove.');
        }
        $new_stock = $previous_stock - $request->quantity;
        $product->stock_quantity = $new_stock;
        $product->save();
        $message = 'Stock removed successfully.';
    }

    stock_log_master::create([
        'product_id' => $request->product_id,
        'quantity' => $request->quantity,
        'transaction_type' => $request->transaction_type,
        'previous_stock' => $previous_stock,
        'new_stock' => $new_stock, 
        'reason' => $request->reason,
    ]);

    return redirect()
        ->back()
        ->with('success', $message);
}



//  public function manage_sales(){
//     return view('sales');
//  }

// public function add_sales(Request $request){
//    $product_data=product::where('status','1')->get();
//    return view('sales',compact('product_data'));
// }




    /*
    |--------------------------------------------------------------------------
    | SALES LIST
    |--------------------------------------------------------------------------
    */

    // public function sales()
    // {
    //     $sales_data = SalesMaster::with('saleProducts')
    //     ->orderBy('id', 'desc')
    //     ->get();

    //     $product_data = Product::where('status', 1)
    //         ->orderBy('product_name', 'asc')
    //         ->get();

    //         $customer =customer::all();

    //     return view('sales', compact(
    //         'sales_data',
    //         'product_data',
    //         'customer',
    //     ));
    // }

// Edit sales

//     public function get_sales($id ='')
// {
//     if(!empty($id)){

//     $sales_data_single = SalesMaster::findOrFail($id);

//     $sale_items = SalesProductListMaster::where(
//         'sale_id',
//         $id
//     )->get();

//     }else{


//     $sales_data = SalesMaster::with('saleProducts')
//     ->orderBy('id', 'desc')
//     ->get();

//     $product_data = Product::where('status', 1)
//         ->orderBy('product_name', 'asc')
//         ->get();

//         $customer =customer::all();

//     // $sales_data = SalesMaster::orderBy('id', 'desc')->get();

//     // $product_data = Product::where('status', 1)
//     //     ->orderBy('product_name', 'asc')
//     //     ->get();

//     }
//     return view('sales', compact(
//         'sales_data',
//         'product_data',
//         'sales_data_single',
//         'sale_items',
//         'customer',
//     ));
// }



public function get_sales($id = '')
{
    if (!empty($id)) {

        $sales_data_single = SalesMaster::findOrFail($id);

        $sale_items = SalesProductListMaster::where(
            'sale_id',
            $id
        )->get();
    } else {
        $sales_data_single = null;
        $sale_items = collect();

    }

    // Sales list - Add aur Edit dono ke liye
    $sales_data = SalesMaster::with('saleProducts')
        ->orderBy('id', 'desc')
        ->get();

    // Product list
    $product_data = Product::where('status', 1)
        ->orderBy('product_name', 'asc')
        ->get();

    // Customer list
    $customer = Customer::all();

    return view('sales', compact(
        'sales_data',
        'product_data',
        'sales_data_single',
        'sale_items',
        'customer'
    ));
}



    /*
    |--------------------------------------------------------------------------
    | ADD SALE
    |--------------------------------------------------------------------------
    */

   
    
    public function add_update_sale(Request $request, $id = null)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'customer_mobile_number' => 'nullable|string|max:10',
            'customer_address' => 'nullable|string',
            'purchase_date' => 'required|date',
            'discount' => 'required|numeric|min:0',
    
            'products' => 'required|array|min:1',
            'products.*.product_id' => 'required|exists:product,id',
            'products.*.quantity' => 'required|numeric|min:0.01',
            'products.*.cost' => 'required|numeric|min:0',
            'products.*.tax' => 'required|numeric|min:0',
            'products.*.total' => 'required|numeric|min:0',
        ]);
    
        DB::beginTransaction();
    
        try {
    
            /*
            |--------------------------------------------------------------------------
            | FIND EXISTING SALE OR GENERATE INVOICE NUMBER
            |--------------------------------------------------------------------------
            */
    
            if ($id) {
    
                // Existing sale ko find karo
                $sale = SalesMaster::where('id', $id)
                    ->lockForUpdate()
                    ->firstOrFail();
    
                // Update mein same invoice number rahega
                $invoice_number = $sale->invoice_number;
    
                /*
                |--------------------------------------------------------------------------
                | RESTORE OLD PRODUCT STOCK
                |--------------------------------------------------------------------------
                */
    
                $old_products = SalesProductListMaster::where(
                    'sale_id',
                    $sale->id
                )->get();
    
                foreach ($old_products as $old_product) {
    
                    $inventory_product = Product::where(
                        'id',
                        $old_product->product_id
                    )->lockForUpdate()->first();
    
                    if (!$inventory_product) {
                        throw new \Exception(
                            'Old sale product not found.'
                        );
                    }
    
                    // Purani sale ki quantity stock mein wapas add karo
                    $inventory_product->stock_quantity =
                        $inventory_product->stock_quantity
                        + $old_product->quantity;
    
                    $inventory_product->save();
                }
    
                // Purane sale-product records remove karo
                SalesProductListMaster::where(
                    'sale_id',
                    $sale->id
                )->delete();
    
            } else {
    
                // New sale ke liye unique invoice number generate karo
                do {
                    $invoice_number = 'INV-'
                        . date('Ymd')
                        . '-'
                        . strtoupper(bin2hex(random_bytes(4)));
    
                } while (
                    SalesMaster::where(
                        'invoice_number',
                        $invoice_number
                    )->exists()
                );
    
                $sale = new SalesMaster();
            }
    
            /*
            |--------------------------------------------------------------------------
            | CALCULATE SUBTOTAL AND TAX
            |--------------------------------------------------------------------------
            */
    
            $sub_total = 0;
            $total_tax = 0;
    
            foreach ($request->products as $product) {
    
                $quantity = (float) $product['quantity'];
                $cost = (float) $product['cost'];
                $tax = (float) $product['tax'];
    
                $item_subtotal = $quantity * $cost;
    
                $sub_total += $item_subtotal;
                $total_tax += $tax;
            }
    
            /*
            |--------------------------------------------------------------------------
            | CALCULATE DISCOUNT AND GRAND TOTAL
            |--------------------------------------------------------------------------
            */
    
            $discount = (float) $request->discount;
    
            $grand_total = $sub_total + $total_tax - $discount;
    
            if ($grand_total < 0) {
                $grand_total = 0;
            }
    
            /*
            |--------------------------------------------------------------------------
            | SAVE OR UPDATE SALES MASTER
            |--------------------------------------------------------------------------
            */
          $customer_data= customer::where('id',$request->customer_id)->first();
          $sale->customer_id = $customer_data->id;
          $customer_name=$customer_data->customer_name;
            $sale->customer_name = $customer_name;
    
            $sale->customer_mobile_number =
                $request->customer_mobile_number;
    
            $sale->customer_address =
                $request->customer_address;
    
            $sale->purchase_date = $request->purchase_date;
    
            $sale->invoice_number = $invoice_number;
    
            $sale->sub_total = $sub_total;
    
            $sale->discount = $discount;
    
            $sale->grand_total = $grand_total;
    
            $sale->status = 1;
            $sale->sale_status = 'completed';
            $sale->cancellation_reason ='';
            $sale->cancelled_at ='';
    
            $sale->save();
    
            /*
            |--------------------------------------------------------------------------
            | SAVE SALE PRODUCTS AND REDUCE STOCK
            |--------------------------------------------------------------------------
            */
    
            foreach ($request->products as $product) {
    
                $quantity = (float) $product['quantity'];
                $cost = (float) $product['cost'];
                $tax = (float) $product['tax'];
    
                $product_subtotal = $quantity * $cost;
    
                $total = $product_subtotal + $tax;
    
                // Lock product row while checking and updating stock
                $inventory_product = Product::where(
                    'id',
                    $product['product_id']
                )->lockForUpdate()->first();
    
                if (!$inventory_product) {
                    throw new \Exception('Product not found.');
                }
    
                if ($inventory_product->stock_quantity < $quantity) {
    
                    throw new \Exception(
                        'Insufficient stock for '
                        . $inventory_product->product_name
                    );
                }
    
                // Insert the sale product record
                SalesProductListMaster::create([
                    'sale_id' => $sale->id,
                    'product_id' => $product['product_id'],
                    'quantity' => $quantity,
                    'cost' => $cost,
                    'tax' => $tax,
                    'total' => $total,
                    'status' => 1,
                ]);
    
                // Reduce stock by the new sale quantity
                $inventory_product->stock_quantity =
                    $inventory_product->stock_quantity - $quantity;
    
                $inventory_product->save();
            }
    
            /*
            |--------------------------------------------------------------------------
            | COMMIT TRANSACTION
            |--------------------------------------------------------------------------
            */
    
            DB::commit();
    
            if ($id) {
    
                return redirect('get_sales/')
                    ->with(
                        'success',
                        'Sale updated successfully. Invoice Number: '
                        . $invoice_number
                    );
            } else {
                return redirect('get_sales/')
                    ->with(
                        'success',
                        'Sale created successfully. Invoice Number: '
                        . $invoice_number
                    );
            }
    
        } catch (\Throwable $e) {
    
            DB::rollBack();
    
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Something went wrong: ' . $e->getMessage()
                );
        }
    }
    

    public function delete_sale($id){
        SalesMaster::where('id',$id)->delete();
        return redirect('get_sales')->with('success','Sale deleted successfully');
    }


    public function sale_invoice($id)
{
    $sale = SalesMaster::with('saleProducts.product')
        ->findOrFail($id);

    return view('sales_invoice', compact('sale'));
}







// Customer function 
    // Show all active customers
    public function get_customer($id='')
    {
        $customers = customer::where('is_deleted', '0')
            ->orderBy('id', 'desc')
            ->get();

            $sales_data = SalesMaster::where('customer_id', $id)
            ->orderBy('id', 'desc')
            ->get();

        return view('customerList', compact('customers','sales_data'));
    }

    // Add new customer


public function add_update_customer(Request $request, $id = null)
{
    $request->validate([
        'customer_name' => 'required|string|max:255',
        'email'         => 'required|email|max:255',
        'phone'         => 'required|string|max:255',
        'address'       => 'required|string|max:255',
        'city'          => 'required|string|max:255',
        'state'         => 'required|string|max:255',
        'pin_code'      => 'required|string|max:255',
        'company_name'  => 'nullable|string|max:255',
        'gst_number'    => 'nullable|string|max:255',
        'notes'         => 'nullable|string',
    ]);

    // Indian timezone
    $current_time = now('Asia/Kolkata');

    $customer_data = [
        'customer_name' => $request->customer_name,
        'email'         => $request->email,
        'phone'         => $request->phone,
        'address'       => $request->address,
        'city'          => $request->city,
        'state'         => $request->state,
        'pin_code'      => $request->pin_code,
        'company_name'  => $request->company_name,
        'gst_number'    => $request->gst_number,
        'notes'         => $request->notes,
    ];

    // Update customer
    if (!empty($id)) {

        $customer = DB::table('customers')
            ->where('id', $id)
            ->where('is_deleted', '0')
            ->first();

        if (!$customer) {
            return redirect()
                ->route('customers.index')
                ->with('error', 'Customer not found!');
        }

        $customer_data['updated_at'] = $current_time;

        DB::table('customers')
            ->where('id', $id)
            ->where('is_deleted', '0')
            ->update($customer_data);

        return redirect('get_customer')
            ->with('success', 'Customer updated successfully!');
    }

    // Add new customer
    $customer_data['is_deleted'] = '0';
    $customer_data['created_at'] = $current_time;
    $customer_data['updated_at'] = $current_time;

    DB::table('customers')->insert($customer_data);

    return redirect('get_customer')
        ->with('success', 'Customer added successfully!');
}





    // Update existing customer
    // public function update(Request $request, $id)
    // {

    //     $request->validate([
    //         'customer_name' => 'required|string|max:255',
    //         'email'          => 'required|email|max:255',
    //         'phone'          => 'required|string|max:255',
    //         'address'        => 'required|string|max:255',
    //         'city'           => 'required|string|max:255',
    //         'state'          => 'required|string|max:255',
    //         'pin_code'       => 'required|string|max:255',
    //         'company_name'   => 'nullable|string|max:255',
    //         'gst_number'     => 'nullable|string|max:255',
    //         'notes'          => 'nullable|string',
    //     ]);

    //     $customer = DB::table('customers')
    //         ->where('id', $id)
    //         ->where('is_deleted', '0')
    //         ->first();

    //     if (!$customer) {
    //         return redirect()
    //             ->route('customers.index')
    //             ->with('error', 'Customer not found!');
    //     }

    //     DB::table('customers')
    //         ->where('id', $id)
    //         ->update([
    //             'customer_name' => $request->customer_name,
    //             'email'         => $request->email,
    //             'phone'         => $request->phone,
    //             'address'       => $request->address,
    //             'city'          => $request->city,
    //             'state'         => $request->state,
    //             'pin_code'      => $request->pin_code,
    //             'company_name'  => $request->company_name,
    //             'gst_number'    => $request->gst_number,
    //             'notes'         => $request->notes,
    //             'updated_at'    => now(),
    //         ]);

    //     return redirect()
    //         ->route('customers.index')
    //         ->with('success', 'Customer updated successfully!');
    // }


 public function get_customer_sales($id)
 {
    
        $customer = customer::where('id', $id)
            ->where('is_deleted', '0')
            ->first();
    
        if (!$customer) {
            return redirect()
                ->route('get_customer')
                ->with('error', 'Customer not found!');
        }
    
        $sales_data = SalesMaster::where('customer_id', $id)
            ->orderBy('id', 'desc')
            ->get();
    
      $total_sales=$sales_data->count();
        $total_grand_total=$sales_data->sum('grand_total');
        $total_discount=$sales_data->sum('discount');

        return view('customer_sales', compact(
            'customer',
            'sales_data',
            'total_grand_total',
            'total_sales',
            'total_discount',
        ));
 }



 public function sale_refunds()
{
    $refunds = DB::table('sale_refunds')
        ->join('sales_master', 'sale_refunds.sale_id', '=', 'sales_master.id')
        ->leftJoin('customers', 'sales_master.customer_id', '=', 'customers.id')
        ->select(
            'sale_refunds.*',
            'sales_master.invoice_number',
            'sales_master.customer_name',
            'customers.phone as customer_phone'
        )
        ->orderByDesc('sale_refunds.id')
        ->get();

    $total_refunds = $refunds->count();

    $pending_refunds = $refunds->where('refund_status', 'pending')->count();

    $processed_refunds = $refunds->where('refund_status', 'processed')->count();

    $total_refund_amount = $refunds
        ->where('refund_status', 'processed')
        ->sum('refund_amount');

    return view('sale_refund', compact(
        'refunds',
        'total_refunds',
        'pending_refunds',
        'processed_refunds',
        'total_refund_amount'
    ));
}



// public function cancel_sale($table, $id)
// {
//     // status 1 = Active, 0 = Cancelled

//     date_default_timezone_set('Asia/Kolkata');
//     $ctime = date('Y-m-d H:i:s');

//     // Only allow cancellation of sales
//     if ($table != 'sales_master') {
//         return redirect()->back()->with('error', 'Invalid sale request.');
//     }

//     try {

//         DB::transaction(function () use ($id ,$ctime) {

//             // Get sale and lock it to prevent duplicate cancellation
//             $sale = DB::table('sales_master')
//                 ->where('id', $id)
//                 ->lockForUpdate()
//                 ->first();

//             if (!$sale) {
//                 throw new \Exception('Sale not found.');
//             }

//             // Assuming status 1 = Active and 0 = Cancelled
//             if ($sale->status == 0) {
//                 throw new \Exception('This sale is already cancelled.');
//             }

//             // Get all products belonging to this sale
//             $saleProducts = DB::table('sales_product_list_master')
//                 ->where('sale_id', $id)
//                 ->get();

//             if ($saleProducts->isEmpty()) {
//                 throw new \Exception('No products found for this sale.');
//             }

//             // Restore stock for each sold product
//             foreach ($saleProducts as $saleProduct) {

//                 DB::table('product')
//                     ->where('id', $saleProduct->product_id)
//                     ->increment('stock_quantity', $saleProduct->quantity);
//             }

//             // Mark sale as cancelled; preserve the original record
//             DB::table('sales_master')
//                 ->where('id', $id)
//                 ->update([
//                     'status' => 0,
//                     'cancellation_reason' => 'Sale cancelled by admin',
//                     'sale_status'=>'cancelled',
//                     'cancelled_at'=> $ctime,
//                 ]);
//         });

//         DB::table('sales_product_list_master')
//     ->where('sale_id', $id)
//     ->update([
//         'status' => 0
//     ]);

//      sale_refunds::create([
//         'sale_id' => $sale->id,
//         'refund_amount' => $sale->grand_total,
//         'refund_method' => '',
//         'refund_status' => 'Pending',
//         'transaction_reference' => null,
//         'refund_reason' => 'Sale cancelled by admin',
//         'processed_at' => null,
//         'created_at' =>$ctime,
//         'updated_at' =>$ctime,
//     ]);   

  
//         return redirect()->back()
//             ->with('success', 'Sale cancelled and stock restored successfully.');

//     } catch (\Exception $e) {

//         return redirect()->back()
//             ->with('error', $e->getMessage());
//     }
// }






public function cancel_sale($table, $id)
{
    date_default_timezone_set('Asia/Kolkata');
    $ctime = date('Y-m-d H:i:s');

    // Only allow sales_master table
    if ($table != 'sales_master') {
        return redirect()->back()->with('error', 'Invalid sale request.');
    }

    try {

        DB::transaction(function () use ($id, $ctime) {

            // Get sale details
            $sale = DB::table('sales_master')
                ->where('id', $id)
                ->lockForUpdate()
                ->first();

            if (!$sale) {
                throw new \Exception('Sale not found.');
            }

            // Check if sale is already cancelled
            if ($sale->status == 0) {
                throw new \Exception('This sale is already cancelled.');
            }

            // Get products included in this sale
            $saleProducts = DB::table('sales_product_list_master')
                ->where('sale_id', $id)
                ->get();

            if ($saleProducts->isEmpty()) {
                throw new \Exception('No products found for this sale.');
            }

            // Restore stock for every sold product
            foreach ($saleProducts as $saleProduct) {

                $product = DB::table('product')
                    ->where('id', $saleProduct->product_id)
                    ->lockForUpdate()
                    ->first();

                if (!$product) {
                    throw new \Exception(
                        'Product not found. Product ID: ' . $saleProduct->product_id
                    );
                }

                DB::table('product')
                    ->where('id', $saleProduct->product_id)
                    ->increment('stock_quantity', $saleProduct->quantity);
            }

            // Update sale status
            DB::table('sales_master')
                ->where('id', $id)
                ->update([
                    'status' => 0,
                    'cancellation_reason' => 'Sale cancelled by admin',
                    'sale_status' => 'cancelled',
                    'cancelled_at' => $ctime,
                ]);

            // Mark sale product entries as cancelled
            DB::table('sales_product_list_master')
                ->where('sale_id', $id)
                ->update([
                    'status' => 0,
                ]);

            // Prevent duplicate refund entries
            $existingRefund = DB::table('sale_refunds')
                ->where('sale_id', $id)
                ->exists();

            if (!$existingRefund) {

                // Create pending refund record
                DB::table('sale_refunds')->insert([
                    'sale_id' => $sale->id,
                    'refund_amount' => $sale->grand_total,
                    'refund_method' =>'',
                    'refund_status' => 'Pending',
                    'transaction_reference' => '',
                    'refund_reason' => 'Sale cancelled by admin',
                    'processed_at' => '',
                    'created_at' => $ctime,
                    'updated_at' => $ctime,
                ]);
            }
        });

        return redirect()->back()->with(
            'success',
            'Sale cancelled and stock restored successfully. Refund is pending.'
        );

    } catch (\Exception $e) {

        return redirect()->back()->with('error', $e->getMessage());
    }
}


public function view_refund($refund_id)
{
    $refund_record=sale_refunds::where('id',$refund_id)->first();
    $sale_id=$refund_record->sale_id;

    $sale = SalesMaster::with('saleProductListMaster.product')
        ->findOrFail($sale_id);

    return view('refund_detail', compact('refund_record','sale'));
}


 }
