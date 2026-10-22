
@extends('admin_master')

@section('content')

<style>

    .purchase-page {
        padding: 20px;
    }

    .purchase-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .purchase-header h3 {
        margin: 0;
        font-weight: 600;
    }

    .add-purchase-btn {
        background: #4169E1;
        color: #fff;
        border: none;
        padding: 9px 18px;
        border-radius: 5px;
    }

    .add-purchase-btn:hover {
        background: #3158d3;
        color: #fff;
    }

    /* ================= FORM PANEL ================= */

    .purchase-form-panel {
        display: none;
        background: #fff;
        padding: 25px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        margin-bottom: 25px;
    }

    .purchase-form-panel.open {
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

    /* ================= SECTION ================= */

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

    /* ================= PRODUCT TABLE ================= */

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

    /* ================= CALCULATION ================= */

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

    .due-row {
        color: #dc3545;
        font-weight: 600;
    }

    /* ================= BUTTONS ================= */

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

    /* ================= LIST ================= */

    .purchase-list-box {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    }

    .purchase-list-box th {
        background: #4169E1;
        color: #fff;
        white-space: nowrap;
    }

    .purchase-list-box td {
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

    @media(max-width: 768px) {

        .purchase-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }

        .calculation-box {
            max-width: 100%;
        }

    }

</style>


<div class="purchase-page">

    <!-- ================================================= -->
    <!-- HEADER -->
    <!-- ================================================= -->

    <div class="purchase-header">

        <h3>
            Purchase Management
        </h3>

        <button type="button"
                class="add-purchase-btn"
                onclick="openAddPurchaseForm()">
            <i class="fa fa-plus"></i>
            Add Purchase
        </button>

    </div>


    <!-- ================================================= -->
    <!-- ADD / UPDATE FORM -->
    <!-- ================================================= -->

    <div id="purchaseFormPanel"
         class="purchase-form-panel
         {{ isset($purchase_data_single) && $purchase_data_single ? 'open' : '' }}">

        <div class="form-title">

            <h4 id="purchaseFormTitle">

                {{ isset($purchase_data_single) && $purchase_data_single
                    ? 'Update Purchase'
                    : 'Add Purchase'
                }}

            </h4>

            <button type="button"
                    class="close-form-btn"
                    onclick="closePurchaseForm()">

                <i class="fa fa-times"></i>

            </button>

        </div>


        <!-- ================================================= -->
        <!-- FORM -->
        <!-- ================================================= -->

        <form id="purchaseForm"

              action="{{ isset($purchase_data_single) && $purchase_data_single
                    ? url('add_update_purchase/' . $purchase_data_single->id)
                    : url('add_update_purchase')
              }}"

              method="POST">

            @csrf


            <!-- ================================================= -->
            <!-- PURCHASE DETAILS -->
            <!-- ================================================= -->

            <div class="section-title">
                Purchase Details
            </div>


            <div class="row">

                <!-- SUPPLIER -->

                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Supplier <span class="text-danger">*</span>
                    </label>

                    <select name="supplier_id"
                            id="supplier_id"
                            class="form-control"
                            required>

                        <option value="">
                            Select Supplier
                        </option>

                        @foreach($supplier_data as $supplier)

                            <option value="{{ $supplier->id }}"

                                {{ old(
                                    'supplier_id',
                                    isset($purchase_data_single)
                                        ? $purchase_data_single->supplier_id
                                        : ''
                                ) == $supplier->id
                                    ? 'selected'
                                    : ''
                                }}>

                                {{ $supplier->supplier_name }}

                            </option>

                        @endforeach

                    </select>

                </div>
                <input type="text"
                           name="invoice_number"
                           id="invoice_number"
                           class="form-control"

                           value="{{ old(
                               'invoice_number',
                               isset($purchase_data_single)
                                   ? $purchase_data_single->invoice_number
                                   : ''
                           ) }}"

                           placeholder="Auto generated"

                           {{ !isset($purchase_data_single)
                               ? 'readonly'
                               : ''
                           }} hidden>


                <!-- INVOICE NUMBER -->

                <!-- <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Invoice Number
                    </label>

                    <input type="text"
                           name="invoice_number"
                           id="invoice_number"
                           class="form-control"

                           value="{{ old(
                               'invoice_number',
                               isset($purchase_data_single)
                                   ? $purchase_data_single->invoice_number
                                   : ''
                           ) }}"

                           placeholder="Auto generated"

                           {{ !isset($purchase_data_single)
                               ? 'readonly'
                               : ''
                           }}>

                    @if(!isset($purchase_data_single))

                        <small class="text-muted">
                            Invoice number will be generated automatically.
                        </small>

                    @endif

                </div> -->


                <!-- PURCHASE DATE -->

                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Purchase Date <span class="text-danger">*</span>
                    </label>

                    <input type="date"
                           name="purchase_date"
                           id="purchase_date"
                           class="form-control"

                           value="{{ old(
                               'purchase_date',
                               isset($purchase_data_single)
                                   ? $purchase_data_single->purchase_date
                                   : date('Y-m-d')
                           ) }}"

                           required>

                </div>

            </div>


            <!-- ================================================= -->
            <!-- PRODUCTS -->
            <!-- ================================================= -->

            <div class="section-title">
                Purchase Products
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
                                Purchase Price
                            </th>

                            <th>
                                Subtotal
                            </th>

                            <th>
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody id="purchaseItems">


                        @if(
                            isset($purchase_data_single) &&
                            $purchase_data_single &&
                            $purchase_data_single->items->count() > 0
                        )

                            @foreach(
                                $purchase_data_single->items
                                as $index => $item
                            )

                                <tr class="product-row">

                                    <!-- PRODUCT -->

                                    <td>

                                        <select
                                            name="products[{{ $index }}][product_id]"
                                            class="form-control product-select"
                                            required>

                                            <option value="">
                                                Select Product
                                            </option>

                                            @foreach($product_data as $product)

                                                <option
                                                    value="{{ $product->id }}"

                                                    data-price="{{ $product->purchase_price }}"

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

                                               name="products[{{ $index }}][quantity]"

                                               class="form-control quantity"

                                               min="1"

                                               value="{{ $item->quantity }}"

                                               required>

                                    </td>


                                    <!-- PURCHASE PRICE -->

                                    <td>

                                        <input type="number"

                                               name="products[{{ $index }}][purchase_price]"

                                               class="form-control purchase-price"

                                               min="0"

                                               step="0.01"

                                               value="{{ $item->purchase_price }}"

                                               required>

                                    </td>


                                    <!-- SUBTOTAL -->

                                    <td>

                                        <input type="number"

                                               name="products[{{ $index }}][subtotal]"

                                               class="form-control item-subtotal"

                                               value="{{ $item->subtotal }}"

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


                            <!-- DEFAULT FIRST ROW -->

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
                                                data-price="{{ $product->purchase_price }}">

                                                {{ $product->product_name }}

                                            </option>

                                        @endforeach

                                    </select>

                                </td>


                                <td>

                                    <input type="number"

                                           name="products[0][quantity]"

                                           class="form-control quantity"

                                           min="1"

                                           value="1"

                                           required>

                                </td>


                                <td>

                                    <input type="number"

                                           name="products[0][purchase_price]"

                                           class="form-control purchase-price"

                                           min="0"

                                           step="0.01"

                                           required>

                                </td>


                                <td>

                                    <input type="number"

                                           name="products[0][subtotal]"

                                           class="form-control item-subtotal"

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
                           name="subtotal"
                           id="subtotal"
                           class="form-control"

                           value="{{ old(
                               'subtotal',
                               isset($purchase_data_single)
                                   ? $purchase_data_single->subtotal
                                   : 0
                           ) }}"

                           readonly>

                </div>


                <!-- TAX PERCENT -->

                <div class="calculation-row">

                    <label>
                        Tax %
                    </label>

                    <input type="number"
                           name="tax_percent"
                           id="tax_percent"
                           class="form-control"

                           min="0"
                           step="0.01"

                           value="{{ old(
                               'tax_percent',
                               isset($purchase_data_single)
                                   ? $purchase_data_single->tax_percent
                                   : 0
                           ) }}"

                           oninput="calculatePurchase()"

                           required>

                </div>


                <!-- TAX AMOUNT -->

                <div class="calculation-row">

                    <label>
                        Tax Amount
                    </label>

                    <input type="number"
                           name="tax_amount"
                           id="tax_amount"
                           class="form-control"

                           value="{{ old(
                               'tax_amount',
                               isset($purchase_data_single)
                                   ? $purchase_data_single->tax_amount
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
                               isset($purchase_data_single)
                                   ? $purchase_data_single->discount
                                   : 0
                           ) }}"

                           oninput="calculatePurchase()"

                           required>

                </div>


                <!-- SHIPPING -->

                <div class="calculation-row">

                    <label>
                        Shipping Charge
                    </label>

                    <input type="number"
                           name="shipping_charge"
                           id="shipping_charge"
                           class="form-control"

                           min="0"
                           step="0.01"

                           value="{{ old(
                               'shipping_charge',
                               isset($purchase_data_single)
                                   ? $purchase_data_single->shipping_charge
                                   : 0
                           ) }}"

                           oninput="calculatePurchase()"

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
                               isset($purchase_data_single)
                                   ? $purchase_data_single->grand_total
                                   : 0
                           ) }}"

                           readonly>

                </div>


                <!-- PAID -->

                <div class="calculation-row">

                    <label>
                        Paid Amount
                    </label>

                    <input type="number"
                           name="paid_amount"
                           id="paid_amount"
                           class="form-control"

                           min="0"
                           step="0.01"

                           value="{{ old(
                               'paid_amount',
                               isset($purchase_data_single)
                                   ? $purchase_data_single->paid_amount
                                   : 0
                           ) }}"

                           oninput="calculateDueAmount()"

                           required>

                </div>


                <!-- DUE -->

                <div class="calculation-row due-row">

                    <label>
                        Due Amount
                    </label>

                    <input type="number"
                           name="due_amount"
                           id="due_amount"
                           class="form-control"

                           value="{{ old(
                               'due_amount',
                               isset($purchase_data_single)
                                   ? $purchase_data_single->due_amount
                                   : 0
                           ) }}"

                           readonly>

                </div>

            </div>


            <!-- ================================================= -->
            <!-- PAYMENT DETAILS -->
            <!-- ================================================= -->

            <div class="section-title">
                Payment Details
            </div>


            <div class="row">


                <!-- PAYMENT METHOD -->

                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Payment Method <span class="text-danger">*</span>
                    </label>

                    <select name="payment_method"
                            id="payment_method"
                            class="form-control"
                            required>

                        <option value="">
                            Select Payment Method
                        </option>

                        <option value="Cash"
                            {{ old(
                                'payment_method',
                                isset($purchase_data_single)
                                    ? $purchase_data_single->payment_method
                                    : ''
                            ) == 'Cash'
                                ? 'selected'
                                : ''
                            }}>
                            Cash
                        </option>

                        <option value="Card"
                            {{ old(
                                'payment_method',
                                isset($purchase_data_single)
                                    ? $purchase_data_single->payment_method
                                    : ''
                            ) == 'Card'
                                ? 'selected'
                                : ''
                            }}>
                            Card
                        </option>

                        <option value="UPI"
                            {{ old(
                                'payment_method',
                                isset($purchase_data_single)
                                    ? $purchase_data_single->payment_method
                                    : ''
                            ) == 'UPI'
                                ? 'selected'
                                : ''
                            }}>
                            UPI
                        </option>

                        <option value="Bank Transfer"
                            {{ old(
                                'payment_method',
                                isset($purchase_data_single)
                                    ? $purchase_data_single->payment_method
                                    : ''
                            ) == 'Bank Transfer'
                                ? 'selected'
                                : ''
                            }}>
                            Bank Transfer
                        </option>

                    </select>

                </div>


                <!-- PAYMENT STATUS -->

                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Payment Status <span class="text-danger">*</span>
                    </label>

                    <select name="payment_status"
                            id="payment_status"
                            class="form-control"
                            required>

                        <option value="">
                            Select Status
                        </option>

                        <option value="Paid"
                            {{ old(
                                'payment_status',
                                isset($purchase_data_single)
                                    ? $purchase_data_single->payment_status
                                    : ''
                            ) == 'Paid'
                                ? 'selected'
                                : ''
                            }}>
                            Paid
                        </option>

                        <option value="Partial"
                            {{ old(
                                'payment_status',
                                isset($purchase_data_single)
                                    ? $purchase_data_single->payment_status
                                    : ''
                            ) == 'Partial'
                                ? 'selected'
                                : ''
                            }}>
                            Partial
                        </option>

                        <option value="Pending"
                            {{ old(
                                'payment_status',
                                isset($purchase_data_single)
                                    ? $purchase_data_single->payment_status
                                    : ''
                            ) == 'Pending'
                                ? 'selected'
                                : ''
                            }}>
                            Pending
                        </option>

                    </select>

                </div>


                <!-- REMARKS -->

                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Remarks
                    </label>

                    <textarea name="remarks"
                              id="remarks"
                              class="form-control"
                              rows="2"
                              placeholder="Enter remarks">{{ old(
                                  'remarks',
                                  isset($purchase_data_single)
                                      ? $purchase_data_single->remarks
                                      : ''
                              ) }}</textarea>

                </div>

            </div>


            <!-- ================================================= -->
            <!-- BUTTONS -->
            <!-- ================================================= -->

            <div class="form-buttons">

                <button type="button"
                        class="cancel-btn"
                        onclick="closePurchaseForm()">

                    Cancel

                </button>

                <button type="submit"
                        class="save-btn"
                        id="purchaseSubmitBtn">

                    {{ isset($purchase_data_single) && $purchase_data_single
                        ? 'Update Purchase'
                        : 'Save Purchase'
                    }}

                </button>

            </div>


        </form>

    </div>


    <!-- ================================================= -->
    <!-- PURCHASE LIST -->
    <!-- ================================================= -->

    <div class="purchase-list-box">

        <div class="table-responsive">

            <table class="table table-bordered table-hover">

                <thead>

                    <tr>

                        <th>#</th>

                        <th>Supplier</th>

                        <th>Invoice Number</th>

                        <th>Purchase Date</th>

                        <th>Subtotal</th>

                        <th>Tax</th>

                        <th>Discount</th>

                        <th>Shipping</th>

                        <th>Grand Total</th>

                        <th>Paid</th>

                        <th>Due</th>

                        <th>Payment Status</th>

                        <th>Action</th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($purchase_data as $purchase)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                {{ $purchase->supplier->supplier_name ?? 'N/A' }}
                            </td>

                            <td>
                                {{ $purchase->invoice_number }}
                            </td>

                            <td>
                                {{ $purchase->purchase_date }}
                            </td>

                            <td>
                                ₹{{ number_format($purchase->subtotal, 2) }}
                            </td>

                            <td>
                                ₹{{ number_format($purchase->tax_amount, 2) }}
                            </td>

                            <td>
                                ₹{{ number_format($purchase->discount, 2) }}
                            </td>

                            <td>
                                ₹{{ number_format($purchase->shipping_charge, 2) }}
                            </td>

                            <td>
                                ₹{{ number_format($purchase->grand_total, 2) }}
                            </td>

                            <td>
                                ₹{{ number_format($purchase->paid_amount, 2) }}
                            </td>

                            <td>
                                ₹{{ number_format($purchase->due_amount, 2) }}
                            </td>

                            <td>

                                @if($purchase->payment_status == 'Paid')

                                    <span class="badge bg-success">
                                        Paid
                                    </span>

                                @elseif($purchase->payment_status == 'Partial')

                                    <span class="badge bg-warning text-dark">
                                        Partial
                                    </span>

                                @else

                                    <span class="badge bg-danger">
                                        Pending
                                    </span>

                                @endif

                            </td>

                            <td>

                            <a href="{{ url('purchase_invoice/' . $purchase->id) }}"
                                   class="btn btn-primary"
                                   title="Edit Purchase">
                              Bill
                                </a>

                                <a href="{{ url('get_purchases/' . $purchase->id) }}"
                                   class="action-btn edit-btn"
                                   title="Edit Purchase">

                                    <i class="fa fa-pencil"></i>

                                </a>


                                <a href="{{ url('delete-record/purchase/id/' . $purchase->id) }}"
                                   class="action-btn delete-btn"
                                   title="Delete Purchase"

                                   onclick="return confirm('Are you sure you want to delete this purchase?')">

                                    <i class="fa fa-trash"></i>

                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="13"
                                class="text-center">

                                No Purchase Found

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>


<!-- ========================================================= -->
<!-- JAVASCRIPT -->
<!-- ========================================================= -->

<script>


// =========================================================
// OPEN ADD FORM
// =========================================================

function openAddPurchaseForm()
{
    document.getElementById('purchaseForm').reset();

    document.getElementById('purchaseForm').action =
        "{{ url('add_update_purchase') }}";

    document.getElementById('purchaseFormTitle').innerText =
        "Add Purchase";

    document.getElementById('purchaseSubmitBtn').innerText =
        "Save Purchase";


    // Reset product rows

    let tbody =
        document.getElementById('purchaseItems');

    tbody.innerHTML = '';


    addProductRow();


    document.getElementById('purchaseFormPanel')
        .classList.add('open');


    calculatePurchase();


    document.getElementById('purchaseFormPanel')
        .scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
}


// =========================================================
// CLOSE FORM
// =========================================================

function closePurchaseForm()
{
    document.getElementById('purchaseFormPanel')
        .classList.remove('open');
}


// =========================================================
// ADD PRODUCT ROW
// =========================================================

function addProductRow()
{
    let tbody =
        document.getElementById('purchaseItems');

    let index =
        tbody.querySelectorAll('.product-row').length;


    let row = document.createElement('tr');

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
                        data-price="{{ $product->purchase_price }}">

                        {{ $product->product_name }}

                    </option>

                @endforeach

            </select>

        </td>


        <td>

            <input type="number"

                   name="products[${index}][quantity]"

                   class="form-control quantity"

                   min="1"

                   value="1"

                   required>

        </td>


        <td>

            <input type="number"

                   name="products[${index}][purchase_price]"

                   class="form-control purchase-price"

                   min="0"

                   step="0.01"

                   required>

        </td>


        <td>

            <input type="number"

                   name="products[${index}][subtotal]"

                   class="form-control item-subtotal"

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


// =========================================================
// REMOVE PRODUCT ROW
// =========================================================

function removeProductRow(button)
{
    let rows =
        document.querySelectorAll('.product-row');


    if (rows.length <= 1) {

        alert('At least one product is required.');

        return;
    }


    button.closest('.product-row').remove();


    reindexProductRows();


    calculatePurchase();
}


// =========================================================
// REINDEX PRODUCT ROWS
// =========================================================

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


        row.querySelector('.purchase-price').name =
            `products[${index}][purchase_price]`;


        row.querySelector('.item-subtotal').name =
            `products[${index}][subtotal]`;

    });
}


// =========================================================
// PRODUCT CHANGE
// =========================================================

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

            row.querySelector('.purchase-price').value =
                price;

        }
        else
        {

            row.querySelector('.purchase-price').value =
                '';

        }


        calculatePurchase();

    }

});


// =========================================================
// QUANTITY / PRICE CHANGE
// =========================================================

document.addEventListener('input', function(event)
{

    if (
        event.target.classList.contains('quantity') ||
        event.target.classList.contains('purchase-price')
    )
    {

        calculatePurchase();

    }

});


// =========================================================
// CALCULATE PURCHASE
// =========================================================

function calculatePurchase()
{

    let rows =
        document.querySelectorAll('.product-row');


    let subtotal = 0;


    rows.forEach(function(row)
    {

        let quantity =
            parseFloat(
                row.querySelector('.quantity').value
            ) || 0;


        let price =
            parseFloat(
                row.querySelector('.purchase-price').value
            ) || 0;


        let itemSubtotal =
            quantity * price;


        row.querySelector('.item-subtotal').value =
            itemSubtotal.toFixed(2);


        subtotal += itemSubtotal;

    });


    document.getElementById('subtotal').value =
        subtotal.toFixed(2);


    let taxPercent =
        parseFloat(
            document.getElementById('tax_percent').value
        ) || 0;


    let taxAmount =
        subtotal * taxPercent / 100;


    document.getElementById('tax_amount').value =
        taxAmount.toFixed(2);


    let discount =
        parseFloat(
            document.getElementById('discount').value
        ) || 0;


    let shipping =
        parseFloat(
            document.getElementById('shipping_charge').value
        ) || 0;


    let grandTotal =
        subtotal +
        taxAmount +
        shipping -
        discount;


    if (grandTotal < 0)
    {
        grandTotal = 0;
    }


    document.getElementById('grand_total').value =
        grandTotal.toFixed(2);


    calculateDueAmount();

}


// =========================================================
// CALCULATE DUE
// =========================================================

function calculateDueAmount()
{

    let grandTotal =
        parseFloat(
            document.getElementById('grand_total').value
        ) || 0;


    let paidAmount =
        parseFloat(
            document.getElementById('paid_amount').value
        ) || 0;


    let dueAmount =
        grandTotal - paidAmount;


    if (dueAmount < 0)
    {
        dueAmount = 0;
    }


    document.getElementById('due_amount').value =
        dueAmount.toFixed(2);

}


// =========================================================
// PAGE LOAD
// =========================================================

document.addEventListener('DOMContentLoaded', function()
{

    calculatePurchase();

});

</script>


@endsection
