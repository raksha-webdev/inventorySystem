<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - {{ $sale->invoice_number }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>
        body {
            background: #f3f4f6;
            font-family: Arial, sans-serif;
            color: #333;
        }

        .invoice-container {
            max-width: 950px;
            margin: 30px auto;
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 3px 18px rgba(0,0,0,0.08);
        }

        .invoice-heading {
            color: #2563eb;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .invoice-number {
            color: #555;
            font-size: 14px;
        }

        .section-title {
            font-size: 15px;
            font-weight: 700;
            margin-bottom: 12px;
            color: #2563eb;
        }

        .table thead th {
            background: #2563eb;
            color: #fff;
            white-space: nowrap;
        }

        .table td,
        .table th {
            padding: 12px;
            vertical-align: middle;
        }

        .summary-box {
            max-width: 360px;
            margin-left: auto;
        }

        .grand-total {
            background: #eff6ff;
            font-size: 19px;
            font-weight: 700;
            color: #1d4ed8;
        }

        .invoice-footer {
            border-top: 1px solid #ddd;
            margin-top: 35px;
            padding-top: 20px;
            text-align: center;
            color: #666;
        }

        @media (max-width: 576px) {
            .invoice-container {
                margin: 10px;
                padding: 18px;
            }

            .invoice-top {
                gap: 15px;
            }

            .table td,
            .table th {
                padding: 8px;
                font-size: 12px;
            }
        }

        @media print {
            body {
                background: #fff;
            }

            .invoice-container {
                max-width: 100%;
                margin: 0;
                padding: 10px;
                box-shadow: none;
                border-radius: 0;
            }

            .no-print {
                display: none !important;
            }

            .table thead th {
                background: #2563eb !important;
                color: #fff !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .grand-total {
                background: #eff6ff !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .table-responsive {
                overflow: visible !important;
            }
        }
    </style>
</head>

<body>

<div class="invoice-container">

    {{-- Action Buttons --}}
    <div class="d-flex justify-content-end gap-2 mb-4 no-print">
        
    <a href="{{ url('/get_sales') }}" class="btn btn-info">
            Back
    </a>


        <button onclick="window.print()" class="btn btn-primary">
            Print / Save PDF
        </button>

        <button onclick="window.close()" class="btn btn-secondary">
            Close
        </button>
    </div>

    {{-- Invoice Header --}}
    <div class="d-flex justify-content-between align-items-start invoice-top mb-4">
        <div>
            <h2 class="invoice-heading mb-1">SALES INVOICE</h2>
            <p class="text-muted mb-0">Customer Sales Bill</p>
        </div>

        <div class="text-end">
            <h5 class="fw-bold mb-1">YOUR COMPANY NAME</h5>
            <p class="text-muted mb-0">Your Company Address</p>
            <p class="text-muted mb-0">Contact: Your Mobile Number</p>
        </div>
    </div>

    <hr>

    {{-- Customer and Invoice Details --}}
    <div class="row g-4 mb-4">

        <div class="col-md-6">
            <h6 class="section-title">BILL TO</h6>

            <p class="mb-1">
                <strong>Customer:</strong>
                {{ $sale->customer_name }}
            </p>

            <p class="mb-1">
                <strong>Mobile:</strong>
                {{ $sale->customer_mobile_number }}
            </p>

            <p class="mb-1">
                <strong>Address:</strong>
                {{ $sale->customer_address }}
            </p>
        </div>

        <div class="col-md-6">
            <h6 class="section-title">INVOICE DETAILS</h6>

            <p class="mb-1">
                <strong>Invoice No:</strong>
                {{ $sale->invoice_number }}
            </p>

            <p class="mb-1">
                <strong>Purchase Date:</strong>
                {{ $sale->purchase_date
                    ? \Carbon\Carbon::parse($sale->purchase_date)->format('d-m-Y')
                    : 'N/A' }}
            </p>

            <p class="mb-1">
                <strong>Bill Status:</strong>
                {{ $sale->status }}
            </p>
        </div>

    </div>

    {{-- Products Table --}}
    <h6 class="section-title">PRODUCT DETAILS</h6>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product Name</th>
                    <th>Qty</th>
                    <th>Unit Price</th>
                    <th>Tax</th>
                    <th>Total</th>
                </tr>
            </thead>

            <tbody>
                @forelse($sale->saleProducts as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>
                            {{ $item->product->product_name ?? 'N/A' }}
                        </td>

                        <td>{{ $item->quantity }}</td>

                        <td>
                            ₹{{ number_format((float) $item->cost, 2) }}
                        </td>

                        <td>
                            ₹{{ number_format((float) $item->tax, 2) }}
                        </td>

                        <td>
                            ₹{{ number_format((float) $item->total, 2) }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">
                            No products found for this sale.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Bill Summary --}}
    <div class="summary-box mt-4">

        <div class="d-flex justify-content-between mb-2">
            <span>Subtotal</span>
            <strong>
                ₹{{ number_format((float) $sale->sub_total, 2) }}
            </strong>
        </div>

        <div class="d-flex justify-content-between mb-2">
            <span>Discount</span>
            <strong>
                ₹{{ number_format((float) $sale->discount, 2) }}
            </strong>
        </div>

        <hr>

        <div class="d-flex justify-content-between p-3 rounded grand-total">
            <span>Grand Total</span>
            <span>
                ₹{{ number_format((float) $sale->grand_total, 2) }}
            </span>
        </div>

    </div>

    {{-- Footer --}}
    <div class="invoice-footer">
        <h6 class="fw-bold">Thank You For Your Business!</h6>
        <p class="mb-0">This is a computer-generated sales invoice.</p>
    </div>

</div>

</body>
</html>