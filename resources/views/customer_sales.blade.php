@extends('admin_master')

@section('title', 'Customer Sales')

@section('heading', 'Customer Sales')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('get_customer') }}">Customers</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
        Customer Sales
    </li>
@endsection

@section('content')

<style>
    .customer-sales-page {
        padding: 10px 5px 25px;
        color: #263247;
    }

    .customer-sales-page * {
        box-sizing: border-box;
    }

    .sales-page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
        margin-bottom: 24px;
    }

    .sales-page-header h3 {
        font-size: 23px;
        font-weight: 700;
        margin: 0 0 6px;
        color: #1e293b;
    }

    .sales-page-header p {
        margin: 0;
        font-size: 13px;
        color: #718096;
    }

    .back-customer-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 16px;
        border: 1px solid #dbe3ef;
        border-radius: 9px;
        color: #334155;
        background: #fff;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        transition: .2s;
    }

    .back-customer-btn:hover {
        background: #f1f5f9;
        color: #1d4ed8;
        text-decoration: none;
    }

    .customer-profile-card {
        display: flex;
        align-items: center;
        gap: 18px;
        padding: 23px;
        margin-bottom: 22px;
        border: 1px solid #e6ebf2;
        border-radius: 15px;
        background: #fff;
        box-shadow: 0 4px 18px rgba(15, 23, 42, .04);
    }

    .customer-avatar {
        width: 64px;
        height: 64px;
        min-width: 64px;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 15px;
        background: #e8efff;
        color: #4169e2;
        font-size: 26px;
    }

    .customer-profile-info {
        min-width: 0;
    }

    .customer-profile-info h4 {
        margin: 0 0 9px;
        font-size: 20px;
        font-weight: 700;
        color: #1e293b;
        overflow-wrap: anywhere;
    }

    .customer-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 8px 20px;
        color: #64748b;
        font-size: 13px;
    }

    .customer-meta span {
        overflow-wrap: anywhere;
    }

    .customer-meta i {
        color: #4169e2;
        margin-right: 5px;
    }

    .sales-summary-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 18px;
        margin-bottom: 25px;
    }

    .summary-card {
        background: #fff;
        border: 1px solid #e6ebf2;
        border-radius: 14px;
        padding: 20px;
        display: flex;
        align-items: center;
        gap: 15px;
        min-width: 0;
        box-shadow: 0 4px 18px rgba(15, 23, 42, .035);
    }

    .summary-icon {
        width: 48px;
        height: 48px;
        min-width: 48px;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 12px;
        font-size: 20px;
    }

    .summary-icon.sales {
        color: #4169e2;
        background: #e8efff;
    }

    .summary-icon.discount {
        color: #d97706;
        background: #fff3dc;
    }

    .summary-icon.amount {
        color: #059669;
        background: #dff8ed;
    }

    .summary-label {
        display: block;
        margin-bottom: 7px;
        color: #718096;
        font-size: 12px;
        font-weight: 600;
    }

    .summary-value {
        display: block;
        color: #1e293b;
        font-size: 21px;
        font-weight: 750;
        overflow-wrap: anywhere;
    }

    .sales-table-card {
        background: #fff;
        border: 1px solid #e6ebf2;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 18px rgba(15, 23, 42, .04);
    }

    .sales-table-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
        padding: 21px 22px;
        border-bottom: 1px solid #edf0f5;
    }

    .sales-table-heading h4 {
        font-size: 17px;
        font-weight: 700;
        color: #1e293b;
        margin: 0 0 5px;
    }

    .sales-table-heading p {
        color: #718096;
        font-size: 12px;
        margin: 0;
    }

    .sales-count-badge {
        display: inline-block;
        padding: 6px 11px;
        border-radius: 20px;
        background: #e8efff;
        color: #3156c9;
        font-size: 12px;
        font-weight: 700;
    }

    .sales-table-wrap {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .customer-sales-table {
        width: 100%;
        min-width: 850px;
        margin: 0;
        border-collapse: collapse;
    }

    .customer-sales-table thead th {
        padding: 15px 17px;
        background: #f8fafc;
        color: #64748b;
        border-bottom: 1px solid #e6ebf2;
        white-space: nowrap;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .45px;
    }

    .customer-sales-table tbody td {
        padding: 16px 17px;
        vertical-align: middle;
        border-bottom: 1px solid #edf0f5;
        color: #475569;
        font-size: 13px;
        white-space: nowrap;
    }

    .customer-sales-table tbody tr:last-child td {
        border-bottom: 0;
    }

    .customer-sales-table tbody tr:hover {
        background: #fafcff;
    }

    .invoice-number {
        color: #3156c9;
        font-weight: 700;
    }

    .sale-date {
        color: #64748b;
    }

    .sale-total {
        color: #059669;
        font-weight: 700;
    }

    .sale-discount {
        color: #d97706;
        font-weight: 600;
    }

    .bill-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 8px 12px;
        border: 1px solid #dbe5ff;
        border-radius: 8px;
        background: #eff4ff;
        color: #3156c9;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        transition: .2s;
    }

    .bill-btn:hover {
        background: #4169e2;
        color: #fff;
        text-decoration: none;
    }

    .empty-sales {
        padding: 55px 20px !important;
        text-align: center;
        white-space: normal !important;
    }

    .empty-sales-icon {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        border-radius: 50%;
        background: #f1f5f9;
        color: #94a3b8;
        font-size: 25px;
    }

    .empty-sales h5 {
        margin-bottom: 7px;
        font-weight: 700;
        color: #334155;
    }

    .empty-sales p {
        margin: 0;
        color: #94a3b8;
        font-size: 13px;
    }

    .sales-table-footer {
        padding: 15px 22px;
        border-top: 1px solid #edf0f5;
        color: #64748b;
        font-size: 12px;
    }

    @media (max-width: 992px) {
        .sales-summary-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .summary-card:last-child {
            grid-column: 1 / -1;
        }
    }

    @media (max-width: 576px) {
        .customer-sales-page {
            padding: 5px 0 18px;
        }

        .sales-page-header h3 {
            font-size: 20px;
        }

        .sales-page-header {
            align-items: flex-start;
        }

        .customer-profile-card {
            align-items: flex-start;
            padding: 17px;
            gap: 12px;
        }

        .customer-avatar {
            width: 48px;
            height: 48px;
            min-width: 48px;
            border-radius: 11px;
            font-size: 20px;
        }

        .customer-profile-info h4 {
            font-size: 17px;
        }

        .customer-meta {
            flex-direction: column;
            gap: 7px;
        }

        .sales-summary-grid {
            grid-template-columns: 1fr;
            gap: 12px;
        }

        .summary-card,
        .summary-card:last-child {
            grid-column: auto;
            padding: 16px;
        }

        .summary-value {
            font-size: 19px;
        }

        .sales-table-heading {
            padding: 17px;
        }

        .sales-table-footer {
            padding: 14px 17px;
        }
    }
</style>

<div class="customer-sales-page">

    {{-- PAGE HEADER --}}
    <div class="sales-page-header">
        <div>
            <h3>Customer Sales History</h3>
            <p>View and manage sales transactions for this customer.</p>
        </div>

        <a href="{{ url('get_customer') }}" class="back-customer-btn">
            <i class="fa fa-arrow-left"></i>
            Back to Customers
        </a>
    </div>

    {{-- CUSTOMER PROFILE --}}
    <div class="customer-profile-card">

        <div class="customer-avatar">
            <i class="fa fa-user"></i>
        </div>

        <div class="customer-profile-info">
            <h4>{{ $customer->customer_name ?? 'Customer' }}</h4>

            <div class="customer-meta">

                <span>
                    <i class="fa fa-phone"></i>
                    {{ $customer->phone ?? 'Mobile not available' }}
                </span>

                <span>
                    <i class="fa fa-envelope"></i>
                    {{ $customer->email ?? 'Email not available' }}
                </span>

                @if(!empty($customer->company_name))
                    <span>
                        <i class="fa fa-building"></i>
                        {{ $customer->company_name }}
                    </span>
                @endif

            </div>
        </div>

    </div>

    {{-- SUMMARY CARDS --}}
    <div class="sales-summary-grid">

        <div class="summary-card">
            <div class="summary-icon sales">
                <i class="fa fa-shopping-cart"></i>
            </div>

            <div>
                <span class="summary-label">Total Sales</span>
                <span class="summary-value">
                    {{ number_format($total_sales) }}
                </span>
            </div>
        </div>

        <div class="summary-card">
            <div class="summary-icon discount">
                <i class="fa fa-tag"></i>
            </div>

            <div>
                <span class="summary-label">Total Discount</span>
                <span class="summary-value">
                    ₹{{ number_format((float) $total_discount, 2) }}
                </span>
            </div>
        </div>

        <div class="summary-card">
            <div class="summary-icon amount">
                <i class="fa fa-indian-rupee-sign"></i>
            </div>

            <div>
                <span class="summary-label">Total Sales Amount</span>
                <span class="summary-value">
                    ₹{{ number_format((float) $total_grand_total, 2) }}
                </span>
            </div>
        </div>

    </div>

    {{-- SALES TABLE --}}
    <div class="sales-table-card">

        <div class="sales-table-heading">
            <div>
                <h4>Sales Transactions</h4>
                <p>All invoices recorded for this customer</p>
            </div>

            <span class="sales-count-badge">
                {{ $total_sales }} {{ $total_sales === 1 ? 'Sale' : 'Sales' }}
            </span>
        </div>

        <div class="sales-table-wrap">
            <table class="customer-sales-table">

                <thead>
                    <tr>
                        <th>#</th>
                        <th>Invoice Number</th>
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
                            <td>{{ $loop->iteration }}</td>

                            <td>
                                <span class="invoice-number">
                                    {{ $sale->invoice_number ?? 'N/A' }}
                                </span>
                            </td>

                            <td class="sale-date">
                                @if(!empty($sale->purchase_date))
                                    {{ \Carbon\Carbon::parse($sale->purchase_date)->format('d M Y') }}
                                @else
                                    N/A
                                @endif
                            </td>

                            <td>
                                ₹{{ number_format((float) $sale->sub_total, 2) }}
                            </td>

                            <td>
                                <span class="sale-discount">
                                    ₹{{ number_format((float) $sale->discount, 2) }}
                                </span>
                            </td>

                            <td>
                                <span class="sale-total">
                                    ₹{{ number_format((float) $sale->grand_total, 2) }}
                                </span>
                            </td>

                            <td>
                                <a href="{{ url('sale_invoice/' . $sale->id) }}"
                                   class="bill-btn"
                                   title="View Bill">
                                    <i class="fa fa-file-invoice"></i>
                                    View Bill
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="empty-sales">
                                <div class="empty-sales-icon">
                                    <i class="fa fa-receipt"></i>
                                </div>

                                <h5>No Sales Found</h5>

                                <p>
                                    No sales transactions are available for this customer yet.
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        <div class="sales-table-footer">
            Showing {{ $total_sales }} {{ $total_sales === 1 ? 'transaction' : 'transactions' }}
        </div>

    </div>

</div>

@endsection