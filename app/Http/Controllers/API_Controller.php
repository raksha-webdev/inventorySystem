<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\product;
use App\Models\purchase;
use App\Models\purchase_items;
use App\Models\user_details;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\customer;
use Validator;
use Illuminate\Support\Facades\DB;

class API_Controller extends Controller
{



    public function get_category()
    {
       $cat_data=category::all();
       return response([
        'status'=>true,
        'category'=>$cat_data,
        'msg'=>'Category Data Fetched Successfully',
       ]);
    }


    public function add_category(Request $request)
{
    // Validation
    $request->validate([
        'cat_name'   => 'required|string|max:255',
        'cat_img'    => $request->category_id
                        ? 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
                        : 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        'status'     => 'required|in:0,1',
        'category_id'=> 'nullable|integer',
    ]);

    // =====================================================
    // UPDATE CATEGORY
    // =====================================================

    if ($request->category_id) {

        $category = Category::find($request->category_id);

        // Category ID doesn't exist
        if (!$category) {
            return response()->json([
                'status' => false,
                'msg'    => 'Category not found',
            ], 404);
        }

        // Keep old image by default
        $cat_img = $category->cat_img;

        // If new image is uploaded
        if ($request->hasFile('cat_img')) {

            $cat_img = saveImgFile(
                $request->file('cat_img'),
                'assests/category_img/'
            );

            // Delete old image
            if ($category->cat_img) {

                $oldImage = public_path(
                    'assests/category_img/' . $category->cat_img
                );

                if (file_exists($oldImage)) {
                    unlink($oldImage);
                }
            }
        }

        // Update category
        $category->update([
            'cat_name' => $request->cat_name,
            'cat_img'  => $cat_img,
            'status'   => $request->status,
        ]);

        return response()->json([
            'status' => true,
            'msg'    => 'Category Updated Successfully',
        ], 200);
    }


    // =====================================================
    // ADD NEW CATEGORY
    // =====================================================

    $cat_img = saveImgFile(
        $request->file('cat_img'),
        'assests/category_img/'
    );

    Category::create([
        'cat_name' => $request->cat_name,
        'cat_img'  => $cat_img,
        'status'   => $request->status,
    ]);

    return response()->json([
        'status' => true,
        'msg'    => 'Category Added Successfully',
    ], 200);
}

    public function category_delete(Request $request)
    {
        $request->validate([
            'category_id'=>'required',
        ]);
        $cat_all_data=category::where('id',$request->category_id)->first();
        $oldImage = public_path('assests/category_img/'.$cat_all_data->cat_img);

        if(file_exists($oldImage))
        {
            unlink($oldImage);
        }
        $cat_all_data->delete();
        return response([
            'status'=>200,
            'msg'=>'Category Deleted Successfully',
           ]);
    }


    // login api
    public function login(Request $request){
      $request->validate([
        'email'=>'required|email',
        'password'=>'required',
      ]);
     $user_data= user_details::where('email',$request->email)->where('password',$request->password)->first();
     if($user_data){
        if($user_data->role=='admin'){
            return response([
                'status'=>200,
                'msg'=>'Admin Login Successfully',
               ]);
               
            // return redirect('/admin_dashboard');
          }else{
            return response([
                'user_details'=>$user_data,
                'status'=>200,
                'msg'=>'Staff Login Successfully',
               ]);
            // return redirect('/staff_dashboard');
          }
     }else{
        return response([
            'status'=>401,
            'msg'=>'Invalid Email or Password',
           ]);
     }


    }

    
    // Supplier API
    public function get_supplier()
    {
       $supplier_data=Supplier::all();
       return response([
        'status'=>200,
        'supplier'=>$supplier_data,
        'msg'=>'Supplier Data Fetched Successfully',
       ]);
    }

    public function add_updateSupplier(Request $request){
        if ($request->filled('supplier_id')) {
       
        $supplier_id=$request->supplier_id;
            $data=Supplier::where('id',$supplier_id)->first();
            if(!$data){
                return response([
                    'status'=>404,
                    'msg'=>'Supplier Not Found',
                   ]);
            }
          $all_data= $data->update([
                'supplier_name'=>$request->supplier_name,
                'email'=>$request->email,
                'contact_person'=>$request->contact_person,
                'phone'=>$request->phone,
                'address'=>$request->address,
                'city'=>$request->city,
                'state'=>$request->state,
                'pin_code'=>$request->pin_code,
                'status'=>$request->status,
                // 'supplier_code'=>$request->supplier_code,
                'alternate_phone'=>$request->alternate_phone,
                'website'=>$request->website,
                'notes'=>$request->notes,
                'gst_number'=>$request->gst_number,
                // 'alternate_phone' =>$request->alternate_phone,
            ]);
            return response([
                'status'=>200,
                'msg'=>'Supplier Updated Successfully',
                // 'data'=>$all_data
            ]);
        }
        else{
            $validator=Validator::make($request->all(),[
                'supplier_name'=>'required',
                'email'=>'required|email',
                'phone'=>'required',
                'address'=>'required',
                'city'=>'required',
                'state'=>'required',
                'pin_code'=>'required',
                'status'=>'required|boolean',
                'alternate_phone'=>'nullable',
                'website'=>'nullable',
                'notes'=>'nullable',
                'gst_number'=>'nullable',
              ]);
        
                if($validator->fails()){
                    return response([
                        'status'=>400,
                        'msg'=>$validator->errors(),
                     ]);
                }
        $supplier_code= 'Supplier_code'.date('Ymd').rand(1000,9999);
              $all_data= Supplier::create([
                    'supplier_name'=>$request->supplier_name,
                    'email'=>$request->email,
                    'contact_person'=>$request->contact_person,
                    'phone'=>$request->phone,
                    'address'=>$request->address,
                    'city'=>$request->city,
                    'state'=>$request->state,
                    'pin_code'=>$request->pin_code,
                    'supplier_code'=>$supplier_code,
                    'status'=>$request->status,
                    'alternate_phone'=>$request->alternate_phone ?? '',
                    'website'=>$request->website ?? '',
                    'notes'=>$request->notes ?? '',
                    'gst_number'=>$request->gst_number ?? '',
                    // 'supplier_name=>$request->alternate_phone,
                ]);
        }
    
        $all_data['msg']="Supplier added Successfully";
        // $all_data['status']=200;
        return response($all_data);
    }

    public function delete_supplier(Request $request){
        $request->validate([
            'supplier_id'=>'required',
        ]);
        $supplier_data=Supplier::where('id',$request->supplier_id)->first();
        if(!$supplier_data){
            return response([
                'status'=>404,
                'msg'=>'Supplier Not Found',
               ]);
        }
        $supplier_data->delete();
        return response([
            'status'=>200,
            'msg'=>'Supplier Deleted Successfully',
           ]);
    }

    public function supplier_details(Request $request){
        $request->validate([
            'supplier_id'=>'required',
        ]);
        $supplier_data=Supplier::where('id',$request->supplier_id)->first();
        if(empty($supplier_data)){
            return response([
                'status'=>404,
                'msg'=>'Supplier Not Found',
               ]);
        }
        return response([
            'status'=>200,
            'supplier'=>$supplier_data,
            'msg'=>'Supplier Details Fetched Successfully',
           ]);
    }

    public function get_customers(){
            
            $customer_data=customer::all();
            return response([
            'status'=>200,
            'customers'=>$customer_data,
            'msg'=>'Customer Data Fetched Successfully',
            ]);
    }
  
    public function customers_detail(Request $request){
        $request->validate([
            'customer_id'=>'required',
        ]);
        $customer_data=customer::where('id',$request->customer_id)->first();
        if(empty($customer_data)){
            return response([
                'status'=>404,
                'msg'=>'Customer Not Found',
               ]);
        }
        return response([
            'status'=>200,
            'customer'=>$customer_data,
            'msg'=>'Customer Details Fetched Successfully',
           ]);
    }

    public function delete_customer(Request $request){
        $request->validate([
            'customer_id'=>'required',
        ]);
        $customer_data=customer::where('id',$request->customer_id)->first();
        if(!$customer_data){
            return response([
                'status'=>404,
                'msg'=>'Customer Not Found',
               ]);
        }
        // $customer_data->delete();
        $customer_data->update([
            'is_deleted'=>'1',
        ]);
        return response([
            'status'=>200,
            'msg'=>'Customer Deleted Successfully',
           ]);
    }

    public function add_update_customer(Request $request){
          
            if ($request->filled('customer_id')) {
        
                $customer_id=$request->customer_id;
                    $data=customer::where('id',$customer_id)->first();
                    if(!$data){
                        return response([
                            'status'=>404,
                            'msg'=>'Customer Not Found',
                        ]);
                    }
                $all_data= $data->update([
                        'customer_name'=>$request->customer_name,
                        'email'=>$request->email,
                        'phone'=>$request->phone,
                        'address'=>$request->address,
                        'city'=>$request->city,
                        'state'=>$request->state,
                        'pin_code'=>$request->pin_code,
                    ]);
                    return response([
                        'status'=>200,
                        'msg'=>'Customer Updated Successfully',
                    ]);
                }
                else{
                    $validator=Validator::make($request->all(),[
                        'customer_name'=>'required',
                        'email'=>'required|email',
                        'phone'=>'required',
                        'address'=>'required',
                        'city'=>'required',
                        'state'=>'required',
                        'pin_code'=>'required',
                    ]);
                
                        if($validator->fails()){
                            return response([
                                'status'=>400,
                                'msg'=>$validator->errors(),
                            ]);
                        }
                    $all_data= customer::create([
                            'customer_name'=>$request->customer_name,
                            'email'=>$request->email,
                            'phone'=>$request->phone,
                            'address'=>$request->address,
                            'city'=>$request->city,
                            'state'=>$request->state,
                            'pin_code'=>$request->pin_code,
                        ]);
                }
            
                $all_data['msg']="Customer added Successfully";
                return response($all_data);
    }



     public function add_update_product(Request $request){
        // dd("API HItt");
        if($request->product_id){
                // dd($request->all());
                $product_id=$request->product_id;
                $data=Product::where('id',$product_id)->first();
                if(!$data){
                    return response([
                        'status'=>404,
                        'msg'=>'Product Not Found',
                    ]);
                }
                $all_data= $data->update([
                    'product_name'=>$request->product_name,
                    'category_id'=>$request->category_id,
                    'supplier_id'=>$request->supplier_id,
                    'sku'=>$request->sku,
                    'barcode'=>$request->barcode,
                    'description'=>$request->description,
                    'purchase_price'=>$request->purchase_price,
                    'selling_price'=>$request->selling_price,
                    'stock_quantity'=>$request->stock_quantity,
                    'minimum_stock'=>$request->minimum_stock,
                    'unit'=>$request->unit,
                    'status'=>$request->status,
                ]);
                return response([
                    'status'=>200,
                    'msg'=>'Product Updated Successfully',
                ]);
        }else{
            $request->validate([
                'product_name'=>'required',
                'category_id'=>'required',
                'supplier_id'=>'required',
                'sku'=>'required|unique:product,sku',
                'barcode'=>'nullable|unique:product,barcode',
                'description'=>'nullable',
                'purchase_price'=>'required|numeric',
                'selling_price'=>'required|numeric',
                'stock_quantity'=>'required|integer',
                'minimum_stock'=>'required|integer',
                'unit'=>'required',
                'status'=>'required|boolean',
            ]); 
        $product_data  = product::create([
                'product_name'=>$request->product_name,
                'category_id'=>$request->category_id,
                'supplier_id'=>$request->supplier_id,
                'sku'=>$request->sku,
                'barcode'=>$request->barcode,
                'description'=>$request->description,
                'purchase_price'=>$request->purchase_price,
                'selling_price'=>$request->selling_price,
                'stock_quantity'=>$request->stock_quantity,
                'minimum_stock'=>$request->minimum_stock,
                'unit'=>$request->unit,
                'status'=>$request->status,
            ]);
            return response([
                'status'=>200,
                'msg'=>'Product Added Successfully',
                'product'=>$product_data,
            ]);
        }
     }

     public function get_products(){
        // $product_data=product::with('category','supplier')->get();
        $product_data=product::all();
        return response([
            'status'=>200,
            'products'=>$product_data,
            'msg'=>'Product Data Fetched Successfully',
        ]);
     }

     public function product_details(Request $request){
        $request->validate([
            'product_id'=>'required',
        ]);
        $product_data=product::where('id',$request->product_id)->first();
        if(empty($product_data)){
            return response([
                'status'=>404,
                'msg'=>'Product Not Found',
               ]);
        }
        return response([
            'status'=>200,
            'product'=>$product_data,
            'msg'=>'Product Details Fetched Successfully',
           ]);
     }


     public function product_delete(Request $request){
        $request->validate([
            'product_id'=>'required',
        ]);
        $product_data=product::where('id',$request->product_id)->first();
        if(!$product_data){
            return response([
                'status'=>404,
                'msg'=>'Product Not Found',
               ]);
        }
        // $product_data->delete();
        $product_data->update([
            'is_deleted'=>'1',
        ]);
        return response([
            'status'=>200,
            'msg'=>'Product Deleted Successfully',
           ]);
}

// public function add_purchase(Request $request){
//   $request->validate([
//     'supplier_id'=>'required',
//     'purchase_date'=>'required',
//     'tax_percent'=>'required',
//     'discount'=>'required',
//     'shipping_charge'=>'required',
//     'paid_amount'=>'required',
//     'due_amount'=>'required',
//     'payment_method'=>'required',
//     'payment_status'=>'required',
//     'remarks'=>'required',

   
//   ]);
//   $lastPurchase = Purchase::latest('id')->first();

// if ($lastPurchase) {
//     $number = $lastPurchase->id + 1;
// } else {
//     $number = 1;
// }

// $invoiceNumber = 'PUR-' . str_pad($number, 6, '0', STR_PAD_LEFT);

// $subtotal = $request->price * $request->quantity;

// $taxAmount = ($subtotal * $request->tax_percent) / 100;

// $grandTotal = $subtotal
//             + $taxAmount
//             + $request->shipping_charge
//             - $request->discount;

// $dueAmount = $grandTotal - $request->paid_amount;


//     $purachse_data= Purchase::create([
//             'supplier_id'=>$request->supplier_id,
//             'invoice_number'=>$invoiceNumber,
//             'purchase_date'=>$request->purchase_date,
//             'subtotal'=>$subtotal,
//             'tax_percent'=>$request->tax_percent,
//             'tax_amount'=>$taxAmount,
//             'discount'=>$request->discount,
//             'shipping_charge'=>$request->shipping_charge,
//             'grand_total'=>$grandTotal,
//             'paid_amount'=>$request->paid_amount,
//             'due_amount'=>$dueAmount,
//             'payment_method'=>$request->payment_method,
//             'payment_status'=>$request->payment_status,
//             'remarks'=>$request->remarks,
//             'is_deleted'=>'0',
//      ]);
//      return response([
//       'msg'=>'Purchase Added Successfully',
//       'purachse_data'=>$purachse_data,
//      ]);

// }



public function add_purchase(Request $request)
{
    $request->validate([
        'supplier_id'      => 'required|exists:suppliers,id',
        'purchase_date'    => 'required|date',
        'tax_percent'      => 'required|numeric',
        'discount'         => 'required|numeric',
        'shipping_charge'  => 'required|numeric',
        'paid_amount'      => 'required|numeric',
        'payment_method' => 'required|in:Cash,Card,UPI,Bank Transfer',
        'payment_status' => 'required|in:Paid,Partial,Pending',
        'remarks'          => 'nullable',
        'products'         => 'required|array|min:1',

        'products.*.product_id'     => 'required|exists:product,id',
        'products.*.quantity'       => 'required|integer|min:1',
        'products.*.purchase_price' => 'required|numeric|min:0',
    ]);

    DB::beginTransaction();

    try {

        // Generate Invoice Number
        $lastPurchase = Purchase::latest('id')->first();

        $number = $lastPurchase ? $lastPurchase->id + 1 : 1;

        $invoiceNumber = 'PUR-' . str_pad($number, 6, '0', STR_PAD_LEFT);

        // Calculate Subtotal
        $subtotal = 0;

        foreach ($request->products as $item) {

            $subtotal += $item['quantity'] * $item['purchase_price'];

        }

        // Calculate Tax
        $taxAmount = ($subtotal * $request->tax_percent) / 100;

        // Grand Total
        $grandTotal = $subtotal + $taxAmount + $request->shipping_charge - $request->discount;

        // Due Amount
        $dueAmount = $grandTotal - $request->paid_amount;

        // Save Purchase
        $purchase = Purchase::create([

            'supplier_id'      => $request->supplier_id,
            'invoice_number'   => $invoiceNumber,
            'purchase_date'    => $request->purchase_date,
            'subtotal'         => $subtotal,
            'tax_percent'      => $request->tax_percent,
            'tax_amount'       => $taxAmount,
            'discount'         => $request->discount,
            'shipping_charge'  => $request->shipping_charge,
            'grand_total'      => $grandTotal,
            'paid_amount'      => $request->paid_amount,
            'due_amount'       => $dueAmount,
            'payment_method'   => $request->payment_method,
            'payment_status'   => $request->payment_status,
            'remarks'          => $request->remarks,
            'is_deleted'       => '0',

        ]);

        // Save Purchase Items & Update Stock
        foreach ($request->products as $item) {

            purchase_items::create([

                'purchase_id'    => $purchase->id,
                'product_id'     => $item['product_id'],
                'quantity'       => $item['quantity'],
                'purchase_price' => $item['purchase_price'],
                'subtotal'       => $item['quantity'] * $item['purchase_price'],

            ]);

            // Increase Stock
            $product = Product::findOrFail($item['product_id']);

            // $product->stock_quantity += $item['quantity'];
            $product->increment('stock_quantity', $item['quantity']);

            // $product->save();
        }

        DB::commit();

        return response()->json([
            'status' => true,
            'message' => 'Purchase Added Successfully',
            'purchase' => $purchase,
            'items' => $purchase->items,
        ], 201);

    } catch (\Exception $e) {

        DB::rollBack();

        return response()->json([
            'status' => false,
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
        ], 500);
    }
}

 
public function get_purchases(Request $request)
{
    $purchases = purchase_items::where('id');
}

}
