@extends('admin_master')

@section('content')

<div class="main-body">
    <div class="page-wrapper">


    <!-- Page-header start -->
    <div class="page-header card">
        <div class="row align-items-end">

            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="icofont icofont-file-code bg-c-blue"></i>

                    <div class="d-inline">
                        <h4>Product List</h4>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="page-header-breadcrumb">

                    <ul class="breadcrumb-title">

                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}">
                                <i class="icofont icofont-home"></i>
                            </a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}">Dashboard</a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="{{ url('get_products') }}">
                                Product List
                            </a>
                        </li>

                    </ul>

                </div>
            </div>

        </div>
    </div>
    <!-- Page-header end -->


    <div class="page-body">

        <div class="row">

            <div class="col-sm-12">

                <!-- Success message -->
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Error message -->
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Validation errors -->
                @if($errors->any())

                    <div class="alert alert-danger">

                        <ul class="mb-0">

                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach

                        </ul>

                    </div>

                @endif


                <!-- ================================================= -->
                <!-- ADD / EDIT SUB CATEGORY FORM -->
                <!-- ================================================= -->

                <div class="card">

                    <div class="toggle-panel @if(isset($product_data_single) && $product_data_single) open @endif"
                         id="productFormPanel">

                        <div class="toggle-form-inner">

                            <div class="d-flex justify-content-between align-items-center mb-2">

                            <h4 class="sub-title" id="productFormTitle">

@if(isset($product_data_single) && $product_data_single)

    Update Product

@else

    Add Product

@endif

</h4>

                                <button type="button"
                                        class="btn-close-form"
                                        onclick="closeProductForm()">
                                    &times;
                                </button>

                            </div>


                            <!-- FORM -->

                            <form id="productForm" action="{{isset($product_data_single)? url('add_update_product/'.$product_data_single->id): url('add_update_product/') }}"
      method="POST"
      enctype="multipart/form-data">
    @csrf


<!-- CATEGORY -->
<div class="form-group row">
    <label class="col-sm-2 col-form-label">
        Category
    </label>

    <div class="col-sm-10">
        <select name="category_id" class="form-control" required>
            <option value="">Select Category</option>

            @foreach($cat_data as $category)
                <option value="{{ $category->id }}"
                {{ old(
                    'category_id',
                    isset($product_data_single)
                        ? $product_data_single->category_id
                        : ''
                ) == $category->id ? 'selected' : '' }}>
                    {{ $category->cat_name }}
                </option>
            @endforeach
        </select>
    </div>
</div>


<!-- SUPPLIER -->
<div class="form-group row">
    <label class="col-sm-2 col-form-label">
        Supplier
    </label>

    <div class="col-sm-10">
        <select name="supplier_id" class="form-control" required>
            <option value="">Select Supplier</option>

            @foreach($supplier_data as $supplier)
                <option value="{{ $supplier->id }}"
                    {{ old('supplier_id', isset($product_data_single) ? $product_data_single->supplier_id : '') == $supplier->id ? 'selected' : '' }}>
                    {{ $supplier->supplier_name }}
                </option>
            @endforeach
        </select>
    </div>
</div>



<!-- Brand id -->
<div class="form-group row">
    <label class="col-sm-2 col-form-label">
        Brand
    </label>

    <div class="col-sm-10">
        <select name="brand_id" class="form-control" required>
            <option value="">Select Brand</option>

            @foreach($brand_data as $brand)
                <option value="{{ $brand->id }}"
                    {{ old('brand_id', isset($product_data_single) ? $product_data_single->brand_id : '') == $brand->id ? 'selected' : '' }}>
                    {{ $brand->name }}
                </option>
            @endforeach
        </select>
    </div>
</div>
<!-- PRODUCT NAME -->
<div class="form-group row">
    <label class="col-sm-2 col-form-label">
        Product Name
    </label>

    <div class="col-sm-10">
        <input type="text"
               name="product_name"
               value="{{ old('product_name', isset($product_data_single) ? $product_data_single->product_name : '') }}"
               class="form-control"
               placeholder="Enter Product Name"
               required>
    </div>
</div>


<!-- SKU -->
<div class="form-group row">
    <label class="col-sm-2 col-form-label">
        SKU
    </label>

    <div class="col-sm-10">
        <input type="text"
               name="sku"
               value="{{ old('sku', isset($product_data_single) ? $product_data_single->sku : '') }}"
               class="form-control"
               placeholder="Enter Product SKU"
               required>
    </div>
</div>


<!-- BARCODE -->
<div class="form-group row">
    <label class="col-sm-2 col-form-label">
        Barcode
    </label>

    <div class="col-sm-10">
        <input type="text"
               name="barcode"
               value="{{ old('barcode', isset($product_data_single) ? $product_data_single->barcode : '') }}"
               class="form-control"
               placeholder="Enter Product Barcode">
    </div>
</div>


<!-- DESCRIPTION -->
<div class="form-group row">
    <label class="col-sm-2 col-form-label">
        Description
    </label>

    <div class="col-sm-10">
        <textarea name="description"
                  class="form-control"
                  placeholder="Enter Product Description">{{ old('description', isset($product_data_single) ? $product_data_single->description : '') }}</textarea>
    </div>
</div>


<!-- PURCHASE PRICE -->
<div class="form-group row">
    <label class="col-sm-2 col-form-label">
        Purchase Price
    </label>

    <div class="col-sm-10">
        <input type="number"
               step="0.01"
               name="purchase_price"
               value="{{ old('purchase_price', isset($product_data_single) ? $product_data_single->purchase_price : '') }}"
               class="form-control"
               placeholder="Enter Purchase Price"
               required>
    </div>
</div>


<!-- SELLING PRICE -->
<div class="form-group row">
    <label class="col-sm-2 col-form-label">
        Selling Price
    </label>

    <div class="col-sm-10">
        <input type="number"
               step="0.01"
               name="selling_price"
               value="{{ old('selling_price', isset($product_data_single) ? $product_data_single->selling_price : '') }}"
               class="form-control"
               placeholder="Enter Selling Price"
               required>
    </div>
</div>


<!-- STOCK QUANTITY -->
<div class="form-group row">
    <label class="col-sm-2 col-form-label">
        Stock Quantity
    </label>

    <div class="col-sm-10">
        <input type="number"
               name="stock_quantity"
               value="{{ old('stock_quantity', isset($product_data_single) ? $product_data_single->stock_quantity : '') }}"
               class="form-control"
               placeholder="Enter Stock Quantity"
               required>
    </div>
</div>


<!-- MINIMUM STOCK -->
<div class="form-group row">
    <label class="col-sm-2 col-form-label">
        Minimum Stock
    </label>

    <div class="col-sm-10">
        <input type="number"
               name="minimum_stock"
               value="{{ old('minimum_stock', isset($product_data_single) ? $product_data_single->minimum_stock : '') }}"
               class="form-control"
               placeholder="Enter Minimum Stock"
               required>
    </div>
</div>


<!-- UNIT -->
<div class="form-group row">
    <label class="col-sm-2 col-form-label">
        Unit
    </label>

    <div class="col-sm-10">
        <select name="unit" class="form-control" required>
            <option value="">Select Unit</option>

            @foreach(['Piece', 'Kg', 'Gram', 'Liter', 'Meter', 'Box'] as $unit)

                <option value="{{ $unit }}"
                    {{ old('unit', isset($product_data_single) ? $product_data_single->unit : '') == $unit ? 'selected' : '' }}>
                    {{ $unit }}
                </option>

            @endforeach
        </select>
    </div>
</div>


<!-- PRODUCT IMAGE -->
<div class="form-group row">
    <label class="col-sm-2 col-form-label">
        Product Image
    </label>

    <div class="col-sm-10">
        <input type="file"
               name="product_image"
               class="form-control"
               accept="image/jpeg,image/png,image/webp">
    </div>
</div>


<!-- STATUS -->
<div class="form-group row">
    <label class="col-sm-2 col-form-label">
        Status
    </label>

    <div class="col-sm-10">
        <select name="status" class="form-control" required>
            <option value="">Select</option>

            <option value="1"
                {{ old('status', isset($product_data_single) ? $product_data_single->status : '') == '1' ? 'selected' : '' }}>
                Active
            </option>

            <option value="0"
                {{ old('status', isset($product_data_single) ? $product_data_single->status : '') == '0' ? 'selected' : '' }}>
                Deactive
            </option>
        </select>
    </div>
</div>



<!-- BUTTONS -->
<div class="form-group row">
    <div class="col-sm-10 offset-sm-2">

        <button type="submit"
                class="btn btn-primary"
                id="productFormSubmitBtn">

            @if(isset($product_data_single) && $product_data_single)
                Update
            @else
                Add
            @endif

        </button>

        <button type="button"
                class="btn btn-secondary"
                onclick="closeProductForm()">

            Cancel

        </button>

    </div>
</div>

  </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- ================================================= -->
    <!-- SUB CATEGORY TABLE -->
    <!-- ================================================= -->

    <div class="page-body">

        <div class="row">

           
<div class="category-card">

<div class="category-card-header">
    <div>
        <h4>Product List</h4>
        <p>Manage all your products</p>
    </div>



    <div style="display: flex; align-items: center; gap: 10px;"> 
        <!-- Search --> 
         <div style="display: flex; align-items: center;">
            <form action="{{ url('get_products') }}" method="GET" class="d-flex align-items-center">
                @csrf
             <input type="text" id="productSearch" class="form-control" name="search_text" placeholder="Search product..." style="width: 220px; height: 40px;" value="{{$search_text}}"> 
             <button type="submit" class="btn btn-primary" onclick="searchProducts()" style="height: 40px; margin-left: 5px;"> 
                <i class="fa fa-search"> </i> Search </button>

                 <!-- Reset Button -->
    <a
        href="{{ url('get_products') }}"
        class="btn btn-secondary"
        style="height: 40px; margin-left: 5px; display: flex; align-items: center;">
         <i class="fa fa-refresh"></i>
        Reset
    </a>

                </form>
             </div>

    <button type="button"
            class="add-category-btn"
            onclick="openAddProductForm()">

        <i class="fa fa-plus"></i>
        Add Product
    </button>
    </div>

</div>


<div class="category-table-wrapper">

    <table class="category-table">

        <thead>
            <tr>

                <th>#</th>

                <th>ID</th>

                <th>Category</th>

                <th>Supplier</th>
                <th>Brand</th>

                <th>Product Name</th>

                <th>SKU</th>

                <th>Barcode</th>

                <th>Description</th>

                <th>Purchase Price</th>

                <th>Selling Price</th>

                <th>Stock Quantity</th>

                <th>Minimum Stock</th>

                <th>Unit</th>

                <th>Product Image</th>

                <th>Status</th>

                <th>Created</th>

                <!-- <th>Updated At</th> -->

                <th>Actions</th>

            </tr>
        </thead>


        <tbody>

            @forelse($product_data as $key => $product)

                <tr>

                    <!-- SERIAL NUMBER -->
                    <td>
                        {{ $key + 1 }}
                    </td>


                    <!-- ID -->
                    <td>
                        {{ $product->id }}
                    </td>


                    <!-- CATEGORY -->
                    
                    <td>
                        {{ $product->category->cat_name ?? 'N/A' }}
                    </td>


                    <!-- SUPPLIER -->
                    <td>
                        {{ $product->supplier->supplier_name ?? 'N/A' }}
                    </td>


                    <td>{{ $product->brand->name ?? 'N/A' }}</td>
                    <!-- PRODUCT NAME -->
                    <td>
                        {{ $product->product_name }}
                    </td>


                    <!-- SKU -->
                    <td>
                        {{ $product->sku }}
                    </td>


                    <!-- BARCODE -->
                    <td>
                        {{ $product->barcode ?? 'N/A' }}
                    </td>


                    <!-- DESCRIPTION -->
                    <td>
                        {{ $product->description ?? 'N/A' }}
                    </td>


                    <!-- PURCHASE PRICE -->
                    <td>
                        ₹{{ $product->purchase_price }}
                    </td>


                    <!-- SELLING PRICE -->
                    <td>
                        ₹{{ $product->selling_price }}
                    </td>


                    <!-- STOCK QUANTITY -->
                    <td>
                        {{ $product->stock_quantity }}
                    </td>


                    <!-- MINIMUM STOCK -->
                    <td>
                        {{ $product->minimum_stock }}
                    </td>


                    <!-- UNIT -->
                    <td>
                        {{ $product->unit }}
                    </td>


                    <!-- PRODUCT IMAGE -->
                    <td>

                        @if(!empty($product->product_image))

                            <img src="{{ asset('assests_uploads/product_image/' . $product->product_image) }}"
                                 width="60"
                                 height="60"
                                 style="object-fit: cover;">

                        @else

                            N/A

                        @endif

                    </td>


                    <!-- STATUS -->
                    <td>

                        @if($product->status == '1')

                            <span class="status-badge status-active">
                                <i class="fa fa-circle"></i>
                                Active
                            </span>

                        @else

                            <span class="status-badge status-inactive">
                                <i class="fa fa-circle"></i>
                                Deactive
                            </span>

                        @endif

                    </td>


                    <!-- CREATED AT -->
                    <td>
                        {{ $product->created_at }}
                    </td>


                    <!-- UPDATED AT -->
                    <!-- <td>
                        {{ $product->updated_at }}
                    </td> -->


                    <!-- ACTIONS -->
                    <td>
                        <div class="action-buttons">

                            <!-- EDIT -->
                            <a href="{{ url('get_products/' .$product->id) }}" class="action-btn edit-btn" title="Edit Product">
                          <i class="fa fa-pencil"></i>
                           </a>


                            <!-- DELETE -->
                                <a href="{{ url('delete-record/product/id/' . $product->id) }}" class="action-btn delete-btn"
                                  title="Delete Product" onclick="return confirm('Are you sure you want to delete this product?')">
                                   <i class="fa fa-trash"></i>
                                </a>
                        </div>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="18" class="empty-category">

                        <i class="fa fa-folder-open"></i>

                        <strong>No Products Found</strong>

                        <span>
                            Add your first product to get started.
                        </span>

                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

</div>

</div>

        </div>

    </div>

</div>


</div>

<!-- ================================================= -->

<!-- SUB CATEGORY SCRIPT -->

<!-- ================================================= -->

<script>

    const productFormPanel = document.getElementById('productFormPanel');
    const productForm = document.getElementById('productForm');
    const productFormTitle = document.getElementById('productFormTitle');
    const productFormSubmit = document.getElementById('productFormSubmitBtn');

    function openAddProductForm()
    {
        productForm.reset();
        productForm.action = "{{ url('add_update_product') }}";
        productFormTitle.textContent = "Add Product";
        productFormSubmit.textContent = "Add";
        productFormPanel.classList.add('open');
        productFormPanel.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    }

    function closeProductForm()
    {
        productFormPanel.classList.remove('open');
    }

</script>

@endsection
