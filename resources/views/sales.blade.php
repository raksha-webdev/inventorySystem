@extends('admin_master')

@section('content')

<style>
    .sales-page {
        padding: 20px;
    }

    .sales-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .sales-header h3 {
        margin: 0;
        font-weight: 600;
    }

    .add-sales-btn {
        background: #4169E1;
        color: #fff;
        border: none;
        padding: 9px 18px;
        border-radius: 5px;
    }

    .add-sales-btn:hover {
        background: #3158d3;
        color: #fff;
    }

    .sales-form-panel {
        display: none;
        background: #fff;
        padding: 25px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        margin-bottom: 25px;
    }

    .sales-form-panel.open {
        display: block;
    }

    .form-title {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 12px;
        margin-bottom: 20px;
        border-bottom: 1px solid #ddd;
    }

    .form-title h4 {
        margin: 0;
        font-weight: 600;
    }

    .close-form-btn {
        border: none;
        background: transparent;
        font-size: 22px;
        color: #555;
        cursor: pointer;
    }

    .section-title {
        background: #f5f7fb;
        border-left: 4px solid #4169E1;
        padding: 10px 15px;
        margin: 20px 0 15px;
        font-weight: 600;
    }

    .form-label {
        font-weight: 500;
    }

    .product-table th {
        background: #4169E1;
        color: #fff;
        white-space: nowrap;
    }

    .product-table td {
        vertical-align: middle;
    }

    .product-select {
        min-width: 220px;
    }

    .remove-product-btn {
        background: #dc3545;
        color: #fff;
        border: none;
        width: 35px;
        height: 35px;
        border-radius: 4px;
    }

    .add-product-row-btn {
        background: #198754;
        color: #fff;
        border: none;
        padding: 8px 15px;
        border-radius: 4px;
    }

    .calculation-box {
        max-width: 450px;
        margin-left: auto;
        margin-top: 25px;
    }

    .calculation-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
    }

    .calculation-row label {
        margin: 0;
        font-weight: 500;
    }

    .calculation-row input {
        width: 200px;
        text-align: right;
    }

    .grand-total-row {
        border-top: 2px solid #4169E1;
        padding-top: 12px;
        font-size: 18px;
        font-weight: 700;
    }

    .form-buttons {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 25px;
    }

    .save-btn {
        background: #4169E1;
        color: #fff;
        border: none;
        padding: 9px 25px;
        border-radius: 5px;
    }

    .cancel-btn {
        background: #6c757d;
        color: #fff;
        border: none;
        padding: 9px 25px;
        border-radius: 5px;
    }

    .sales-list-box {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    }

    .sales-list-box th {
        background: #4169E1;
        color: #fff;
        white-space: nowrap;
    }

    .sales-list-box td {
        vertical-align: middle;
        white-space: nowrap;
    }

    .action-btn {
        width: 34px;
        height: 34px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 4px;
        text-decoration: none;
        margin-right: 4px;
    }

    .edit-btn {
        background: #ffc107;
        color: #000;
    }

    .delete-btn {
        background: #dc3545;
        color: #fff;
    }

    .cancel-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 6px 12px;
    font-size: 12px;
    font-weight: 600;
    line-height: 1.4;
    background-color: #dc3545;
    color: #fff;
    border: 1px solid #dc3545;
    border-radius: 5px;
    text-decoration: none;
    white-space: nowrap;
    cursor: pointer;
    transition: all 0.2s ease;
}

.cancel-btn:hover {
    background-color: #bb2d3b;
    border-color: #b02a37;
    color: #fff;
    text-decoration: none;
}

.cancel-btn:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.2);
}



.cancelled-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 6px 12px;
    font-size: 12px;
    font-weight: 600;
    line-height: 1.4;
    background-color:#39ADB5;
    color: #fff;
    border: 1px solid #39ADB5;
    border-radius: 5px;
    text-decoration: none;
    white-space: nowrap;
    cursor: pointer;
    transition: all 0.2s ease;
}

.cancelled-btn:hover {
    background-color:#39ADB5;
    border-color: #39ADB5;
    color: #fff;
    text-decoration: none;
}

.cancelled-btn:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.2);
}


    @media(max-width: 768px) {

        .sales-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }

        .calculation-box {
            max-width: 100%;
        }
    }
</style>


<div class="sales-page">

    <!-- ================================================= -->
    <!-- HEADER -->
    <!-- ================================================= -->

    <div class="sales-header">

        <h3>
            Sales Management
        </h3>

        <button type="button"
                class="add-sales-btn"
                onclick="openAddSalesForm()">

            <i class="fa fa-plus"></i>
            Add Sale

        </button>

    </div>


    <!-- ================================================= -->
    <!-- ADD / UPDATE FORM -->
    <!-- ================================================= -->

    <div id="salesFormPanel"
         class="sales-form-panel
         {{ isset($sales_data_single) && $sales_data_single ? 'open' : '' }}">

        <div class="form-title">

            <h4 id="salesFormTitle">

                {{ isset($sales_data_single) && $sales_data_single
                    ? 'Update Sale'
                    : 'Add Sale'
                }}

            </h4>

            <button type="button"
                    class="close-form-btn"
                    onclick="closeSalesForm()">

                <i class="fa fa-times"></i>

            </button>

        </div>


@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">

        <strong>Please fix the following errors:</strong>

        <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>

        <!-- <button type="button" class="btn-close"
            data-bs-dismiss="alert" aria-label="Close">
        </button> -->

    </div>
@endif




        <!-- ================================================= -->
        <!-- FORM -->
        <!-- ================================================= -->

        <form id="salesForm"

              action="{{ isset($sales_data_single) && $sales_data_single
                    ? url('add_update_sale/' . $sales_data_single->id)
                    : url('add_update_sale')
              }}" method="POST">
            @csrf


            <!-- ================================================= -->
            <!-- CUSTOMER DETAILS -->
            <!-- ================================================= -->

            <div class="section-title">
                Customer Details
            </div>


            <div class="row">

                <!-- CUSTOMER NAME -->

                <div class="col-md-4 mb-3">

                     <label class="form-label">
                        Customer Name <span class="text-danger">*</span>
                    </label>

                  <!--  <input type="text"
                           name="customer_name"
                           class="form-control"
                           value="{{ old(
                               'customer_name',
                               isset($sales_data_single)
                                   ? $sales_data_single->customer_name
                                   : ''
                           ) }}"
                           > -->


                           <select name="customer_id" id="" class="form-control">
                            <option value="">Select customer</option>
                              @foreach($customer as $customer_name)
                                  <option value="{{ $customer_name->id}}" {{ old('customer_id', isset($sales_data_single) && $sales_data_single ? $sales_data_single->customer_id : '') == $customer_name->id ? 'selected' : '' }}>{{ $customer_name->customer_name }}</option>
                            @endforeach
                           </select>
                </div>


                <!-- CUSTOMER MOBILE -->

                <div class="col-md-4 mb-3">
                    <label class="form-label">
                        Customer Mobile Number
                    </label>

                    <input type="text"
                           name="customer_mobile_number"
                           id="customer_mobile_number"
                           class="form-control"
                           maxlength="10"
                           value="{{ old(
                               'customer_mobile_number',
                               isset($sales_data_single)
                                   ? $sales_data_single->customer_mobile_number
                                   : ''
                           ) }}">
                </div>


                <!-- PURCHASE DATE -->

                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Sale Date <span class="text-danger">*</span>
                    </label>

                    <input type="date"
                           name="purchase_date"
                           id="purchase_date"
                           class="form-control"

                           value="{{ old(
                               'purchase_date',
                               isset($sales_data_single)
                                   ? $sales_data_single->purchase_date
                                   : date('Y-m-d')
                           ) }}"
                           required>
                </div>


                <!-- CUSTOMER ADDRESS -->

                <div class="col-md-8 mb-3">

                    <label class="form-label">
                        Customer Address
                    </label>

                    <textarea name="customer_address"
                              id="customer_address"
                              class="form-control"
                              rows="2">{{ old(
                                  'customer_address',
                                  isset($sales_data_single)
                                      ? $sales_data_single->customer_address
                                      : ''
                              ) }}</textarea>

                </div>


                <!-- INVOICE NUMBER -->

                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Invoice Number
                    </label>

                    <input type="text"
                           class="form-control"
                           value="{{ isset($sales_data_single)
                               ? $sales_data_single->invoice_number
                               : 'Auto Generated'
                           }}"
                           readonly>

                    <small class="text-muted">
                        Invoice number will be generated automatically.
                    </small>

                </div>

            </div>


            <!-- ================================================= -->
            <!-- PRODUCTS -->
            <!-- ================================================= -->

            <div class="section-title">
                Products
            </div>


            <div class="table-responsive">

                <table class="table table-bordered product-table">

                    <thead>

                        <tr>

                            <th>
                                Product
                            </th>

                            <th>
                                Quantity
                            </th>

                            <th>
                                Selling Price
                            </th>

                            <th>
                                Tax
                            </th>

                            <th>
                                Total
                            </th>

                            <th>
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody id="salesItems">

                        @if(isset($sale_items) && count($sale_items) > 0)

                            @foreach($sale_items as $item)

                                <tr class="product-row">

                                    <!-- PRODUCT -->

                                    <td>

                                        <select
                                            name="products[{{ $loop->index }}][product_id]"
                                            class="form-control product-select"
                                            required>

                                            <option value="">
                                                Select Product
                                            </option>

                                            @foreach($product_data as $product)

                                                <option
                                                    value="{{ $product->id }}"
                                                    data-price="{{ $product->selling_price }}"

                                                    {{ $item->product_id == $product->id
                                                        ? 'selected'
                                                        : ''
                                                    }}>

                                                    {{ $product->product_name }}

                                                </option>

                                            @endforeach

                                        </select>

                                    </td>


                                    <!-- QUANTITY -->

                                    <td>
                                        <input type="number"
                                               name="products[{{ $loop->index }}][quantity]"
                                               class="form-control quantity"
                                               min="0.01"
                                               step="0.01"
                                               value="{{ $item->quantity }}"
                                               required>
                                    </td>

                                    <!-- SELLING PRICE -->
                                    <td>
                                        <input type="number"
                                               name="products[{{ $loop->index }}][cost]"
                                               class="form-control selling-price"
                                               min="0"
                                               step="0.01"
                                               value="{{ $item->cost }}"
                                               required>

                                    </td>


                                    <!-- TAX -->

                                    <td>

                                        <input type="number"
                                               name="products[{{ $loop->index }}][tax]"
                                               class="form-control item-tax"
                                               min="0"
                                               step="0.01"
                                               value="{{ $item->tax }}"
                                               required>

                                    </td>


                                    <!-- TOTAL -->

                                    <td>

                                        <input type="number"
                                               name="products[{{ $loop->index }}][total]"
                                               class="form-control item-total"
                                               value="{{ $item->total }}"
                                               readonly>

                                    </td>


                                    <!-- DELETE -->

                                    <td>

                                        <button type="button"
                                                class="remove-product-btn"
                                                onclick="removeProductRow(this)">

                                            <i class="fa fa-trash"></i>

                                        </button>

                                    </td>

                                </tr>

                            @endforeach

                        @else

                            <tr class="product-row">

                                <td>

                                    <select
                                        name="products[0][product_id]"
                                        class="form-control product-select"
                                        required>

                                        <option value="">
                                            Select Product
                                        </option>

                                        @foreach($product_data as $product)

                                            <option
                                                value="{{ $product->id }}"
                                                data-price="{{ $product->selling_price }}">

                                                {{ $product->product_name }}

                                            </option>

                                        @endforeach

                                    </select>

                                </td>


                                <td>

                                    <input type="number"
                                           name="products[0][quantity]"
                                           class="form-control quantity"
                                           min="0.01"
                                           step="0.01"
                                           value="1"
                                           required>

                                </td>


                                <td>

                                    <input type="number"
                                           name="products[0][cost]"
                                           class="form-control selling-price"
                                           min="0"
                                           step="0.01"
                                           value="0"
                                           required>

                                </td>


                                <td>

                                    <input type="number"
                                           name="products[0][tax]"
                                           class="form-control item-tax"
                                           min="0"
                                           step="0.01"
                                           value="0"
                                           required>

                                </td>


                                <td>

                                    <input type="number"
                                           name="products[0][total]"
                                           class="form-control item-total"
                                           value="0"
                                           readonly>

                                </td>


                                <td>

                                    <button type="button"
                                            class="remove-product-btn"
                                            onclick="removeProductRow(this)">

                                        <i class="fa fa-trash"></i>

                                    </button>

                                </td>

                            </tr>

                        @endif

                    </tbody>

                </table>

            </div>


            <!-- ADD PRODUCT -->

            <button type="button"
                    class="add-product-row-btn"
                    onclick="addProductRow()">

                <i class="fa fa-plus"></i>
                Add Product

            </button>


            <!-- ================================================= -->
            <!-- CALCULATION -->
            <!-- ================================================= -->

            <div class="calculation-box">

                <!-- SUBTOTAL -->

                <div class="calculation-row">

                    <label>
                        Subtotal
                    </label>

                    <input type="number"
                           name="sub_total"
                           id="sub_total"
                           class="form-control"
                           value="{{ old(
                               'sub_total',
                               isset($sales_data_single)
                                   ? $sales_data_single->sub_total
                                   : 0
                           ) }}"
                           readonly>

                </div>


                <!-- DISCOUNT -->

                <div class="calculation-row">

                    <label>
                        Discount
                    </label>

                    <input type="number"
                           name="discount"
                           id="discount"
                           class="form-control"
                           min="0"
                           step="0.01"

                           value="{{ old(
                               'discount',
                               isset($sales_data_single)
                                   ? $sales_data_single->discount
                                   : 0
                           ) }}"

                           oninput="calculateSale()"
                           required>

                </div>


                <!-- GRAND TOTAL -->

                <div class="calculation-row grand-total-row">

                    <label>
                        Grand Total
                    </label>

                    <input type="number"
                           name="grand_total"
                           id="grand_total"
                           class="form-control"

                           value="{{ old(
                               'grand_total',
                               isset($sales_data_single)
                                   ? $sales_data_single->grand_total
                                   : 0
                           ) }}"

                           readonly>

                </div>

            </div>


            <!-- ================================================= -->
            <!-- BUTTONS -->
            <!-- ================================================= -->

            <div class="form-buttons">

                <button type="button"
                        class="cancel-btn"
                        onclick="closeSalesForm()">

                    Cancel

                </button>


                <button type="submit"
                        class="save-btn"
                        id="salesSubmitBtn">

                    {{ isset($sales_data_single) && $sales_data_single
                        ? 'Update Sale'
                        : 'Save Sale'
                    }}

                </button>

            </div>

        </form>

    </div>


    <!-- ================================================= -->
    <!-- SALES LIST -->
    <!-- ================================================= -->

    <div class="sales-list-box">

        <div class="table-responsive">

            <table class="table table-bordered table-hover">

                <thead>

                    <tr>

                        <th>#</th>
                        <th>Customer</th>
                        <th>Mobile</th>
                        <th>Invoice Number</th>
                        <th>Product Quantity</th>
                        <th>Sale Date</th>
                        <th>Subtotal</th>
                        <th>Discount</th>
                        <th>Grand Total</th>
                        <th>Action</th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($sales_data as $sale)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                {{ $sale->customer_name }}
                            </td>

                            <td>
                                {{ $sale->customer_mobile_number ?? 'N/A' }}
                            </td>

                            <td>
                                {{ $sale->invoice_number }}
                            </td>

                            <td>
                          
                            @forelse($sale->saleProducts as $saleProduct)
        <div>
            @php
             $product_name=DB::table('product')->where('id',$saleProduct->product_id)->value('product_name');
            @endphp
            Product: {{ $product_name}}
            | Quantity: {{ $saleProduct->quantity }}
        </div>
    @empty
        No products found
    @endforelse

                            </td>

                            <td>
                                {{ $sale->purchase_date }}
                            </td>

                            <td>
                                ₹{{ number_format($sale->sub_total, 2) }}
                            </td>

                            <td>
                                ₹{{ number_format($sale->discount, 2) }}
                            </td>

                            <td>
                                ₹{{ number_format($sale->grand_total, 2) }}
                            </td>

                            <td>
                                <a href="{{ url('sale_invoice/' . $sale->id) }}"
                                   class="btn btn-primary"
                                   title="View Bill">
                                    Bill
                                </a>
                                <a href="{{ url('get_sales/' . $sale->id) }}"
                                   class="action-btn edit-btn"
                                   title="Edit Sale">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="{{ url('delete_sale/'.$sale->id) }}" class="action-btn delete-btn"
                                   title="Delete Sale"
                                   onclick="return confirm('Are you sure you want to delete this sale?')"><i class="fa fa-trash"></i> </a> 

                                   @if($sale->status == 1)
<form action="{{ url('cancel_sale/sales_master/' . $sale->id) }}"
      method="POST"
      style="display:inline;">
    @csrf
    <button type="submit"
            class="cancel-btn"
            onclick="return confirm('Are you sure you want to cancel this sale?')">
        Cancel Sale
    </button>
</form>
@else
    <span class="badge cancelled-btn">Cancelled</span>
@endif

                            </td>
                        </tr>
                    @empty

                        <tr>

                            <td colspan="9"
                                class="text-center">

                                No Sales Found

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>


<script>

/* =========================================================
   OPEN ADD FORM
========================================================= */

function openAddSalesForm()
{
    document.getElementById('salesForm').reset();

    document.getElementById('salesForm').action =
        "{{ url('add_update_sale') }}";

    document.getElementById('salesFormTitle').innerText =
        "Add Sale";

    document.getElementById('salesSubmitBtn').innerText =
        "Save Sale";


    let tbody =
        document.getElementById('salesItems');

    tbody.innerHTML = '';

    addProductRow();


    document.getElementById('purchase_date').value =
        new Date().toISOString().split('T')[0];


    document.getElementById('salesFormPanel')
        .classList.add('open');


    calculateSale();


    document.getElementById('salesFormPanel')
        .scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
}


/* =========================================================
   CLOSE FORM
========================================================= */

function closeSalesForm()
{
    document.getElementById('salesFormPanel')
        .classList.remove('open');
}


/* =========================================================
   ADD PRODUCT ROW
========================================================= */

function addProductRow()
{
    let tbody =
        document.getElementById('salesItems');

    let index =
        tbody.querySelectorAll('.product-row').length;


    let row =
        document.createElement('tr');

    row.classList.add('product-row');


    row.innerHTML = `

        <td>

            <select
                name="products[${index}][product_id]"
                class="form-control product-select"
                required>

                <option value="">
                    Select Product
                </option>

                @foreach($product_data as $product)

                    <option
                        value="{{ $product->id }}"
                        data-price="{{ $product->selling_price }}">

                        {{ $product->product_name }}

                    </option>

                @endforeach

            </select>

        </td>


        <td>

            <input type="number"
                   name="products[${index}][quantity]"
                   class="form-control quantity"
                   min="0.01"
                   step="0.01"
                   value="1"
                   required>

        </td>


        <td>

            <input type="number"
                   name="products[${index}][cost]"
                   class="form-control selling-price"
                   min="0"
                   step="0.01"
                   value="0"
                   required>

        </td>


        <td>

            <input type="number"
                   name="products[${index}][tax]"
                   class="form-control item-tax"
                   min="0"
                   step="0.01"
                   value="0"
                   required>

        </td>


        <td>

            <input type="number"
                   name="products[${index}][total]"
                   class="form-control item-total"
                   value="0"
                   readonly>

        </td>


        <td>

            <button type="button"
                    class="remove-product-btn"
                    onclick="removeProductRow(this)">

                <i class="fa fa-trash"></i>

            </button>

        </td>

    `;


    tbody.appendChild(row);
}


/* =========================================================
   REMOVE PRODUCT
========================================================= */

function removeProductRow(button)
{
    let rows =
        document.querySelectorAll('.product-row');


    if (rows.length <= 1)
    {
        alert('At least one product is required.');
        return;
    }


    button.closest('.product-row').remove();

    reindexProductRows();

    calculateSale();
}


/* =========================================================
   REINDEX
========================================================= */

function reindexProductRows()
{
    let rows =
        document.querySelectorAll('.product-row');


    rows.forEach(function(row, index)
    {

        row.querySelector('.product-select').name =
            `products[${index}][product_id]`;


        row.querySelector('.quantity').name =
            `products[${index}][quantity]`;


        row.querySelector('.selling-price').name =
            `products[${index}][cost]`;


        row.querySelector('.item-tax').name =
            `products[${index}][tax]`;


        row.querySelector('.item-total').name =
            `products[${index}][total]`;

    });
}


/* =========================================================
   PRODUCT CHANGE
========================================================= */

document.addEventListener('change', function(event)
{

    if (event.target.classList.contains('product-select'))
    {

        let option =
            event.target.options[
                event.target.selectedIndex
            ];


        let price =
            option.getAttribute('data-price');


        let row =
            event.target.closest('.product-row');


        if (price !== null && price !== '')
        {
            row.querySelector('.selling-price').value =
                price;
        }
        else
        {
            row.querySelector('.selling-price').value =
                '';
        }


        calculateSale();

    }

});


/* =========================================================
   INPUT CHANGE
========================================================= */

document.addEventListener('input', function(event)
{

    if (
        event.target.classList.contains('quantity') ||
        event.target.classList.contains('selling-price') ||
        event.target.classList.contains('item-tax') ||
        event.target.id === 'discount'
    )
    {
        calculateSale();
    }

});


/* =========================================================
   CALCULATE SALE
========================================================= */

function calculateSale()
{
    let rows = document.querySelectorAll('.product-row');

    let subtotal = 0;
    let totalTax = 0;

    rows.forEach(function(row)
    {
        let quantity =
            parseFloat(
                row.querySelector('.quantity').value
            ) || 0;

        let price =
            parseFloat(
                row.querySelector('.selling-price').value
            ) || 0;

        let tax =
            parseFloat(
                row.querySelector('.item-tax').value
            ) || 0;

        let itemSubtotal = quantity * price;

        let itemTotal = itemSubtotal + tax;

        row.querySelector('.item-total').value =
            itemTotal.toFixed(2);

        subtotal += itemSubtotal;
        totalTax += tax;
    });

    document.getElementById('sub_total').value =
        subtotal.toFixed(2);

    let discount =
        parseFloat(
            document.getElementById('discount').value
        ) || 0;

    let grandTotal =
        subtotal + totalTax - discount;

    if (grandTotal < 0)
    {
        grandTotal = 0;
    }

    document.getElementById('grand_total').value =
        grandTotal.toFixed(2);
}



/* =========================================================
   PAGE LOAD
========================================================= */

document.addEventListener('DOMContentLoaded', function()
{
    calculateSale();
});

</script>


@endsection