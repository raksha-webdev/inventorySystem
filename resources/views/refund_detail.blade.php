
@extends('admin_master')

@section('title', 'View Refund')
@section('heading', 'View Refund')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('manage_refunds') }}">Manage Refunds</a>
    </li>
    <li class="breadcrumb-item active">View Refund</li>
@endsection

@section('content')

<style>
    .refund-detail-card {
        background: #fff;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
        max-width: 1100px;
        margin: 0 auto;
    }

    .refund-page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 22px;
        padding-bottom: 15px;
        border-bottom: 1px solid #eee;
    }

    .refund-page-header h5 {
        margin: 0;
        font-weight: 700;
        color: #263445;
    }

    .refund-section-title {
        font-size: 16px;
        font-weight: 700;
        color: #263445;
        margin: 25px 0 10px;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
    }

    .refund-detail-row {
        padding: 13px 0;
        border-bottom: 1px solid #f0f0f0;
        min-height: 65px;
    }

    .refund-label {
        color: #6c757d;
        font-size: 13px;
        margin-bottom: 5px;
    }

    .refund-value {
        font-size: 14px;
        font-weight: 600;
        color: #212529;
        overflow-wrap: anywhere;
    }

    .refund-status {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        display: inline-block;
    }

    .pending-status {
        background: #fff3cd;
        color: #856404;
    }

    .refunded-status {
        background: #d4edda;
        color: #155724;
    }

    .failed-status {
        background: #f8d7da;
        color: #721c24;
    }

    .refund-table th {
        background: #f5f7fa;
        color: #495057;
        font-size: 13px;
        white-space: nowrap;
    }

    .refund-table td {
        font-size: 13px;
        vertical-align: middle;
    }

    .refund-actions {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: 25px;
        flex-wrap: wrap;
    }

    .refund-process-btn {
        background: #198754;
        color: #fff;
        border: none;
        padding: 9px 17px;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
    }

    .refund-process-btn:hover {
        background: #146c43;
        color: #fff;
    }

    .refund-back-btn {
        background: #6c757d;
        color: #fff;
        padding: 8px 15px;
        border-radius: 6px;
        font-size: 13px;
        text-decoration: none;
    }

    .refund-back-btn:hover {
        background: #565e64;
        color: #fff;
    }

    @media(max-width: 576px) {
        .refund-detail-card {
            padding: 15px;
        }

        .refund-page-header {
            align-items: flex-start;
        }

        .refund-page-header h5 {
            font-size: 16px;
        }

        .refund-detail-row {
            min-height: auto;
            padding: 10px 0;
        }

        .refund-actions {
            flex-direction: column;
            align-items: stretch;
        }

        .refund-actions a {
            text-align: center;
        }
    }
</style>

<div class="refund-detail-card">

    <!-- Page Header -->
    <div class="refund-page-header">

        <h5>
            <i class="fa fa-money"></i>
            Refund Details #{{ $refund->id }}
        </h5>

        <a href="{{ url('manage_refunds') }}" class="refund-back-btn">
            <i class="fa fa-arrow-left"></i> Back
        </a>

    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Error Message -->
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Refund Information -->
    <h6 class="refund-section-title">
        <i class="fa fa-info-circle"></i>
        Refund Information
    </h6>

    <div class="row">

        <div class="col-md-6">
            <div class="refund-detail-row">
                <div class="refund-label">Refund ID</div>
                <div class="refund-value">{{ $refund->id }}</div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="refund-detail-row">
                <div class="refund-label">Sale ID</div>
                <div class="refund-value">{{ $refund->sale_id }}</div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="refund-detail-row">
                <div class="refund-label">Refund Amount</div>
                <div class="refund-value">
                    ₹{{ number_format((float) $refund->refund_amount, 2) }}
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="refund-detail-row">
                <div class="refund-label">Refund Method</div>
                <div class="refund-value">
                    {{ $refund->refund_method ?: 'Not selected' }}
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="refund-detail-row">
                <div class="refund-label">Refund Status</div>
                <div class="refund-value">

                    @if($refund->refund_status == 'Pending')
                        <span class="refund-status pending-status">
                            Pending
                        </span>
                    @elseif($refund->refund_status == 'Refunded')
                        <span class="refund-status refunded-status">
                            Refunded
                        </span>
                    @elseif($refund->refund_status == 'Failed')
                        <span class="refund-status failed-status">
                            Failed
                        </span>
                    @else
                        <span class="refund-status pending-status">
                            {{ $refund->refund_status }}
                        </span>
                    @endif

                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="refund-detail-row">
                <div class="refund-label">Transaction Reference</div>
                <div class="refund-value">
                    {{ $refund->transaction_reference ?: 'N/A' }}
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="refund-detail-row">
                <div class="refund-label">Refund Reason</div>
                <div class="refund-value">
                    {{ $refund->refund_reason ?: 'N/A' }}
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="refund-detail-row">
                <div class="refund-label">Processed At</div>
                <div class="refund-value">
                    {{ $refund->processed_at ?: 'Not processed' }}
                </div>
            </div>
        </div>

    </div>

    <!-- Original Sale Information -->
    <h6 class="refund-section-title">
        <i class="fa fa-shopping-cart"></i>
        Original Sale Information
    </h6>

    @if($sale)

        <div class="row">

            <div class="col-md-6">
                <div class="refund-detail-row">
                    <div class="refund-label">Invoice Number</div>
                    <div class="refund-value">
                        {{ $sale->invoice_number ?? 'N/A' }}
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="refund-detail-row">
                    <div class="refund-label">Customer Name</div>
                    <div class="refund-value">
                        {{ $sale->customer_name ?? 'N/A' }}
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="refund-detail-row">
                    <div class="refund-label">Sale Date</div>
                    <div class="refund-value">
                        {{ $sale->purchase_date ?? 'N/A' }}
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="refund-detail-row">
                    <div class="refund-label">Original Sale Amount</div>
                    <div class="refund-value">
                        ₹{{ number_format((float) ($sale->grand_total ?? 0), 2) }}
                    </div>
                </div>
            </div>

        </div>

        <!-- Sale Products -->
        <h6 class="refund-section-title">
            <i class="fa fa-cubes"></i>
            Sale Products
        </h6>

        <div class="table-responsive">
            <table class="table table-bordered refund-table">

                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($sale->items as $key => $item)

                        <tr>
                            <td>{{ $key + 1 }}</td>

                            <td>
                             
                                {{ $item->product->product_name ?? 'N/A' }}
                            </td>

                            <td>
                                {{ $item->quantity ?? 0 }}
                            </td>

                            <td>
                                ₹{{ number_format((float) ($item->price ?? 0), 2) }}
                            </td>

                            <td>
                                ₹{{ number_format((float) ($item->total ?? 0), 2) }}
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                No products found.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>
        </div>

    @else

        <div class="alert alert-warning">
            Original sale record not found.
        </div>

    @endif

    <!-- Action Buttons -->
    <div class="refund-actions">

        @if($refund->refund_status == 'Pending')

            <a href="{{ url('process_refund/' . $refund->id) }}"
               class="refund-process-btn"
               onclick="return confirm('Are you sure you want to process this refund?')">

                <i class="fa fa-money"></i>
                Process Refund

            </a>

        @endif

        <a href="{{ url('manage_refunds') }}" class="refund-back-btn">
            <i class="fa fa-arrow-left"></i>
            Back to Refunds
        </a>

    </div>

</div>

@endsection
