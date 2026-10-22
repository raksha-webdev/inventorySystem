<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        Purchase Invoice -
        {{ $purchase_detail->invoice_number }}
    </title>


    <style>

        * {
            box-sizing: border-box;
        }


        body {

            margin: 0;

            padding: 30px;

            background: #f5f6fa;

            font-family:
                Arial,
                Helvetica,
                sans-serif;

            color: #222;
        }


        .invoice-wrapper {

            max-width: 1000px;

            margin: auto;

            background: #fff;

            padding: 35px;

            box-shadow:
                0 0 20px
                rgba(0,0,0,0.08);
        }


        /* =========================================
           PRINT BUTTON
        ========================================= */

        .print-button {

            max-width: 1000px;

            margin:
                0 auto 20px;

            text-align: right;
        }


        .print-button button {

            background: #222;

            color: #fff;

            border: none;

            padding:
                10px 18px;

            border-radius: 5px;

            cursor: pointer;

            font-size: 13px;
        }


        .print-button button:hover {

            opacity: .9;
        }


        /* =========================================
           HEADER
        ========================================= */

        .invoice-header {

            display: flex;

            justify-content:
                space-between;

            gap: 30px;

            padding-bottom: 25px;

            border-bottom:
                2px solid #222;
        }


        .company-section {

            width: 55%;
        }


        .company-name {

            margin:
                0 0 8px;

            font-size: 27px;

            font-weight: 700;
        }


        .company-tagline {

            color: #777;

            font-size: 14px;

            margin-bottom: 10px;
        }


        .company-contact {

            font-size: 13px;

            line-height: 1.7;

            color: #444;
        }


        .invoice-section {

            width: 45%;

            text-align: right;
        }


        .invoice-title {

            margin:
                0 0 8px;

            font-size: 30px;

            font-weight: 700;

            letter-spacing: 1px;
        }


        .invoice-number {

            font-size: 14px;

            margin-bottom: 10px;
        }


        .status {

            display: inline-block;

            padding:
                7px 14px;

            border-radius: 5px;

            font-size: 12px;

            font-weight: 600;

            text-transform:
                uppercase;
        }


        .status-paid {

            background: #e8f7ed;

            color: #16833b;
        }


        .status-pending {

            background: #fff4df;

            color: #b76b00;
        }


        .status-due {

            background: #ffe9e9;

            color: #c62828;
        }


        /* =========================================
           META
        ========================================= */

        .invoice-meta {

            display: grid;

            grid-template-columns:
                repeat(2, 1fr);

            gap: 15px;

            margin:
                25px 0;
        }


        .meta-box {

            border:
                1px solid #ddd;

            padding:
                13px 15px;

            border-radius: 5px;
        }


        .meta-label {

            display: block;

            font-size: 11px;

            color: #777;

            text-transform:
                uppercase;

            margin-bottom: 5px;
        }


        .meta-value {

            font-size: 14px;

            font-weight: 600;
        }


        /* =========================================
           ADDRESS
        ========================================= */

        .address-grid {

            display: grid;

            grid-template-columns:
                repeat(3, 1fr);

            gap: 18px;

            margin-bottom: 30px;
        }


        .address-box {

            border:
                1px solid #ddd;

            border-radius: 6px;

            padding: 18px;

            min-height: 170px;
        }


        .section-title {

            font-size: 12px;

            text-transform:
                uppercase;

            font-weight: 700;

            color: #777;

            margin-bottom: 12px;

            letter-spacing: .5px;
        }


        .customer-name {

            font-size: 16px;

            font-weight: 700;

            margin-bottom: 8px;
        }


        .customer-detail {

            font-size: 13px;

            line-height: 1.7;

            color: #555;
        }


        /* =========================================
           PRODUCT TABLE
        ========================================= */

        .product-table-wrapper {

            width: 100%;

            overflow-x: auto;
        }


        .product-table {

            width: 100%;

            border-collapse:
                collapse;

            margin-top: 10px;
        }


        .product-table th {

            background: #f1f2f4;

            padding:
                12px 10px;

            text-align: left;

            font-size: 12px;

            text-transform:
                uppercase;

            border:
                1px solid #ddd;
        }


        .product-table td {

            padding:
                13px 10px;

            border:
                1px solid #ddd;

            font-size: 13px;

            vertical-align:
                middle;
        }


        .product-name {

            font-weight: 600;
        }


        .product-sku {

            display: block;

            margin-top: 4px;

            font-size: 11px;

            color: #777;
        }


        .text-center {

            text-align:
                center !important;
        }


        .text-right {

            text-align:
                right !important;
        }


        /* =========================================
           AMOUNT WORDS
        ========================================= */

        .amount-words {

            margin-top: 25px;

            border:
                1px solid #ddd;

            border-radius: 6px;

            padding: 15px;
        }


        .amount-words-title {

            font-size: 12px;

            color: #777;

            font-weight: 700;

            text-transform:
                uppercase;

            margin-bottom: 7px;
        }


        .amount-words-text {

            font-size: 14px;

            font-weight: 600;

            line-height: 1.6;
        }


        /* =========================================
           BOTTOM
        ========================================= */

        .bottom-section {

            display: grid;

            grid-template-columns:
                1fr 380px;

            gap: 35px;

            margin-top: 30px;
        }


        .payment-box,
        .amount-box {

            border:
                1px solid #ddd;

            border-radius: 6px;

            padding: 20px;
        }


        .box-title {

            font-size: 14px;

            font-weight: 700;

            margin-bottom: 15px;

            padding-bottom: 10px;

            border-bottom:
                1px solid #ddd;
        }


        .payment-row {

            display: flex;

            justify-content:
                space-between;

            gap: 15px;

            padding: 7px 0;

            font-size: 13px;
        }


        .payment-row span:first-child {

            color: #777;
        }


        /* =========================================
           SUMMARY
        ========================================= */

        .summary-row {

            display: flex;

            justify-content:
                space-between;

            gap: 20px;

            padding: 9px 0;

            font-size: 14px;
        }


        .summary-row span:first-child {

            color: #555;
        }


        .summary-row.grand-total {

            margin-top: 8px;

            padding-top: 15px;

            border-top:
                2px solid #222;

            font-size: 18px;

            font-weight: 700;
        }


        .summary-row.paid {

            color: #16833b;
        }


        .summary-row.due {

            color: #c62828;

            font-weight: 600;
        }


        /* =========================================
           REMARKS
        ========================================= */

        .remarks {

            margin-top: 25px;

            padding: 18px;

            border:
                1px solid #ddd;

            border-radius: 6px;
        }


        .remarks-title {

            font-size: 13px;

            font-weight: 700;

            margin-bottom: 7px;
        }


        .remarks-text {

            font-size: 13px;

            color: #555;

            line-height: 1.6;
        }


        /* =========================================
           SIGNATURE
        ========================================= */

        .signature-section {

            margin-top: 55px;

            display: flex;

            justify-content:
                flex-end;
        }


        .signature {

            width: 220px;

            text-align: center;
        }


        .signature-space {

            height: 45px;
        }


        .signature-line {

            border-top:
                1px solid #222;

            margin-bottom: 8px;
        }


        .signature-text {

            font-size: 12px;

            color: #555;
        }


        /* =========================================
           FOOTER
        ========================================= */

        .invoice-footer {

            margin-top: 40px;

            padding-top: 15px;

            border-top:
                1px solid #ddd;

            text-align: center;

            font-size: 11px;

            color: #777;
        }


        /* =========================================
           RESPONSIVE
        ========================================= */

        @media(max-width: 768px) {

            body {

                padding: 10px;
            }


            .invoice-wrapper {

                padding: 20px;
            }


            .invoice-header {

                flex-direction:
                    column;
            }


            .company-section,
            .invoice-section {

                width: 100%;

                text-align:
                    left;
            }


            .invoice-title {

                font-size: 25px;
            }


            .address-grid {

                grid-template-columns:
                    1fr;
            }


            .invoice-meta {

                grid-template-columns:
                    1fr;
            }


            .bottom-section {

                grid-template-columns:
                    1fr;
            }


            .signature-section {

                justify-content:
                    center;
            }

        }


        /* =========================================
           PRINT
        ========================================= */

        @media print {

            body {

                padding: 0;

                background: #fff;
            }


            .invoice-wrapper {

                box-shadow: none;

                max-width: 100%;

                padding: 20px;
            }


            .print-button {

                display: none;
            }


            @page {

                size: A4;

                margin: 10mm;
            }

        }

    </style>

</head>


<body>


    <!-- =========================================
         PRINT BUTTON
    ========================================== -->

    <div class="print-button">

        <button onclick="window.print()">

            Print Invoice

        </button>

        <a href="{{ url('get_purchases/') }}" clas="btn btn-info text-decoration-none">Back</a>

    </div>



    <div class="invoice-wrapper">


        <!-- =========================================
             HEADER
        ========================================== -->

        <div class="invoice-header">


            <!-- BUSINESS -->

            <div class="company-section">

                <h1 class="company-name">

                    {{ $business['name'] }}

                </h1>


                <div class="company-tagline">

                    Inventory Management System

                </div>


                <div class="company-contact">

                    {{ $business['address'] }}

                    <br>

                    {{ $business['city'] }},
                    {{ $business['state'] }}
                    -
                    {{ $business['pin_code'] }}

                    <br>

                    Phone:
                    {{ $business['phone'] }}

                    <br>

                    Email:
                    {{ $business['email'] }}

                    <br>

                    GSTIN:
                    {{ $business['gst_number'] }}

                </div>

            </div>



            <!-- INVOICE -->

            <div class="invoice-section">

                <h2 class="invoice-title">

                    PURCHASE INVOICE

                </h2>


                <div class="invoice-number">

                    Invoice No:

                    <strong>

                        {{ $purchase_detail->invoice_number }}

                    </strong>

                </div>


                @php

                    $paymentStatus =
                        strtolower(
                            trim(
                                $purchase_detail->payment_status
                                ?? ''
                            )
                        );

                @endphp


                @if($paymentStatus == 'paid')

                    <span class="status status-paid">

                        Paid

                    </span>

                @elseif(
                    $paymentStatus == 'pending'
                    ||
                    $paymentStatus == 'partial'
                )

                    <span class="status status-pending">

                        {{ ucfirst($paymentStatus) }}

                    </span>

                @else

                    <span class="status status-due">

                        {{ ucfirst(
                            $paymentStatus ?: 'Due'
                        ) }}

                    </span>

                @endif

            </div>

        </div>



        <!-- =========================================
             META
        ========================================== -->

        <div class="invoice-meta">


            <!-- PURCHASE DATE -->

            <div class="meta-box">

                <span class="meta-label">

                    Purchase Date

                </span>


                <span class="meta-value">

                    {{ $purchase_detail->purchase_date
                        ? \Carbon\Carbon::parse(
                            $purchase_detail->purchase_date
                        )->format('d M Y')
                        : 'N/A'
                    }}

                </span>

            </div>



            <!-- PAYMENT METHOD -->

            <div class="meta-box">

                <span class="meta-label">

                    Payment Method

                </span>


                <span class="meta-value">

                    {{ ucfirst(
                        $purchase_detail->payment_method
                        ?? 'N/A'
                    ) }}

                </span>

            </div>

        </div>



        <!-- =========================================
             SUPPLIER / BILL TO / SHIP TO
        ========================================== -->

        <div class="address-grid">


            <!-- =====================================
                 SUPPLIER
            ====================================== -->

            <div class="address-box">

                <div class="section-title">

                    Supplier / Vendor

                </div>


                <div class="customer-name">

                    {{ $supplier_detail?->supplier_name
                        ?? 'N/A'
                    }}

                </div>


                <div class="customer-detail">


                    @if(!empty(
                        $supplier_detail?->address
                    ))

                        {{ $supplier_detail->address }}

                        <br>

                    @endif


                    @if(!empty(
                        $supplier_detail?->city
                    ))

                        {{ $supplier_detail->city }}

                    @endif


                    @if(!empty(
                        $supplier_detail?->state
                    ))

                        ,
                        {{ $supplier_detail->state }}

                    @endif


                    @if(!empty(
                        $supplier_detail?->pin_code
                    ))

                        -
                        {{ $supplier_detail->pin_code }}

                    @endif


                    @if(!empty(
                        $supplier_detail?->phone
                    ))

                        <br>

                        Phone:
                        {{ $supplier_detail->phone }}

                    @endif


                    @if(!empty(
                        $supplier_detail?->email
                    ))

                        <br>

                        Email:
                        {{ $supplier_detail->email }}

                    @endif


                    @if(!empty(
                        $supplier_detail?->gst_number
                    ))

                        <br>

                        GSTIN:
                        {{ $supplier_detail->gst_number }}

                    @endif

                </div>

            </div>



            <!-- =====================================
                 BILL TO
            ====================================== -->

            <div class="address-box">

                <div class="section-title">

                    Bill To

                </div>


                <div class="customer-name">

                    {{ $business['name'] }}

                </div>


                <div class="customer-detail">

                    {{ $business['address'] }}

                    <br>

                    {{ $business['city'] }},
                    {{ $business['state'] }}
                    -
                    {{ $business['pin_code'] }}

                    <br>

                    Phone:
                    {{ $business['phone'] }}

                    <br>

                    Email:
                    {{ $business['email'] }}

                    <br>

                    GSTIN:
                    {{ $business['gst_number'] }}

                </div>

            </div>



            <!-- =====================================
                 SHIP TO
            ====================================== -->

            <div class="address-box">

                <div class="section-title">

                    Ship To / Shipping Address

                </div>


                <div class="customer-name">

                    {{ $business['name'] }}

                </div>


                <div class="customer-detail">

                    {{ $business['address'] }}

                    <br>

                    {{ $business['city'] }},
                    {{ $business['state'] }}
                    -
                    {{ $business['pin_code'] }}

                    <br>

                    India

                    <br>

                    Contact:
                    {{ $business['phone'] }}

                </div>

            </div>

        </div>



        <!-- =========================================
             PRODUCTS
        ========================================== -->

        <div class="product-table-wrapper">

            <table class="product-table">


                <thead>

                    <tr>

                        <th
                            class="text-center"
                            style="width:55px;"
                        >
                            #
                        </th>


                        <th>

                            Product

                        </th>


                        <th
                            style="width:120px;"
                        >

                            SKU

                        </th>


                        <th
                            class="text-center"
                            style="width:80px;"
                        >

                            Qty

                        </th>


                        <th
                            class="text-right"
                            style="width:130px;"
                        >

                            Purchase Price

                        </th>


                        <th
                            class="text-right"
                            style="width:140px;"
                        >

                            Amount

                        </th>

                    </tr>

                </thead>



                <tbody>


                    @forelse(
                        $product_list
                        as $product
                    )


                        @php

                            $product_detail =
                                DB::table('product')
                                ->where(
                                    'id',
                                    $product->product_id
                                )
                                ->first();

                        @endphp


                        <tr>


                            <!-- # -->

                            <td class="text-center">

                                {{ $loop->iteration }}

                            </td>



                            <!-- PRODUCT -->

                            <td>

                                <div class="product-name">

                                    {{ $product_detail?->product_name
                                        ?? 'N/A'
                                    }}

                                </div>

                            </td>



                            <!-- SKU -->

                            <td>

                                {{ $product_detail?->sku
                                    ?? 'N/A'
                                }}

                            </td>



                            <!-- QUANTITY -->

                            <td class="text-center">

                                {{ $product->quantity }}

                                @if(
                                    !empty(
                                        $product_detail?->unit
                                    )
                                )

                                    {{ $product_detail->unit }}

                                @endif

                            </td>



                            <!-- PURCHASE PRICE -->

                            <td class="text-right">

                                ₹{{
                                    number_format(
                                        (float)
                                        $product->purchase_price,
                                        2
                                    )
                                }}

                            </td>



                            <!-- AMOUNT -->

                            <td class="text-right">

                                ₹{{
                                    number_format(
                                        (float)
                                        $product->subtotal,
                                        2
                                    )
                                }}

                            </td>

                        </tr>


                    @empty


                        <tr>

                            <td
                                colspan="6"
                                class="text-center"
                            >

                                No products found.

                            </td>

                        </tr>


                    @endforelse


                </tbody>

            </table>

        </div>



        <!-- =========================================
             AMOUNT IN WORDS
        ========================================== -->

        <div class="amount-words">


            <div class="amount-words-title">

                Amount in Words

            </div>


            <div class="amount-words-text">

                {{ $grand_total_words }}

            </div>

        </div>



        <!-- =========================================
             PAYMENT + SUMMARY
        ========================================== -->

        <div class="bottom-section">


            <!-- =====================================
                 PAYMENT INFORMATION
            ====================================== -->

            <div class="payment-box">


                <div class="box-title">

                    Payment Information

                </div>


                <div class="payment-row">

                    <span>

                        Payment Status

                    </span>


                    <strong>

                        {{ ucfirst(
                            $purchase_detail->payment_status
                            ?? 'N/A'
                        ) }}

                    </strong>

                </div>


                <div class="payment-row">

                    <span>

                        Payment Method

                    </span>


                    <strong>

                        {{ ucfirst(
                            $purchase_detail->payment_method
                            ?? 'N/A'
                        ) }}

                    </strong>

                </div>


                <div class="payment-row">

                    <span>

                        Purchase ID

                    </span>


                    <strong>

                        #{{ $purchase_detail->id }}

                    </strong>

                </div>


                @if(
                    !empty(
                        $purchase_detail->remarks
                    )
                )

                    <div class="payment-row">

                        <span>

                            Remarks

                        </span>


                        <strong>

                            {{ $purchase_detail->remarks }}

                        </strong>

                    </div>

                @endif

            </div>



            <!-- =====================================
                 SUMMARY
            ====================================== -->

            <div class="amount-box">


                <div class="box-title">

                    Invoice Summary

                </div>


                <!-- SUBTOTAL -->

                <div class="summary-row">

                    <span>

                        Subtotal

                    </span>


                    <span>

                        ₹{{
                            number_format(
                                (float)
                                $purchase_detail->subtotal,
                                2
                            )
                        }}

                    </span>

                </div>



                <!-- TAX -->

                <div class="summary-row">

                    <span>

                        Tax

                        @if(
                            $purchase_detail->tax_percent
                            > 0
                        )

                            (
                            {{
                                number_format(
                                    (float)
                                    $purchase_detail
                                    ->tax_percent,
                                    2
                                )
                            }}%
                            )

                        @endif

                    </span>


                    <span>

                        ₹{{
                            number_format(
                                (float)
                                $purchase_detail
                                ->tax_amount,
                                2
                            )
                        }}

                    </span>

                </div>



                <!-- DISCOUNT -->

                <div class="summary-row">

                    <span>

                        Discount

                    </span>


                    <span>

                        - ₹{{
                            number_format(
                                (float)
                                $purchase_detail
                                ->discount,
                                2
                            )
                        }}

                    </span>

                </div>



                <!-- SHIPPING -->

                <div class="summary-row">

                    <span>

                        Shipping Charge

                    </span>


                    <span>

                        ₹{{
                            number_format(
                                (float)
                                $purchase_detail
                                ->shipping_charge,
                                2
                            )
                        }}

                    </span>

                </div>



                <!-- GRAND TOTAL -->

                <div
                    class="summary-row grand-total"
                >

                    <span>

                        Grand Total

                    </span>


                    <span>

                        ₹{{
                            number_format(
                                (float)
                                $purchase_detail
                                ->grand_total,
                                2
                            )
                        }}

                    </span>

                </div>



                <!-- PAID -->

                <div
                    class="summary-row paid"
                >

                    <span>

                        Paid Amount

                    </span>


                    <span>

                        ₹{{
                            number_format(
                                (float)
                                $purchase_detail
                                ->paid_amount,
                                2
                            )
                        }}

                    </span>

                </div>



                <!-- DUE -->

                <div
                    class="summary-row due"
                >

                    <span>

                        Due Amount

                    </span>


                    <span>

                        ₹{{
                            number_format(
                                (float)
                                $purchase_detail
                                ->due_amount,
                                2
                            )
                        }}

                    </span>

                </div>


            </div>

        </div>



        <!-- =========================================
             REMARKS
        ========================================== -->

        @if(
            !empty(
                $purchase_detail->remarks
            )
        )

            <div class="remarks">


                <div class="remarks-title">

                    Remarks

                </div>


                <div class="remarks-text">

                    {{ $purchase_detail->remarks }}

                </div>


            </div>

        @endif



        <!-- =========================================
             SIGNATURE
        ========================================== -->

        <div class="signature-section">


            <div class="signature">


                <div class="signature-space"></div>


                <div class="signature-line"></div>


                <div class="signature-text">

                    Authorized Signature

                </div>


            </div>

        </div>



        <!-- =========================================
             FOOTER
        ========================================== -->

        <div class="invoice-footer">

            This is a computer-generated
            purchase invoice.

            <br>

            Generated from Inventory
            Management System.

        </div>


    </div>



</body>

</html>