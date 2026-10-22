@extends('Admin.include.admin_master')

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
        box-shadow: 0 2px 12px rgba(0,0,0,0.06);
        max-width: 900px;
    }

    .refund-detail-row {
        padding: 13px 0;
        border-bottom: 1px solid #eee;
    }

    .refund-label {
        color: #6c757d;
        font-size: 14px;
    }

    .refund-value {
        font-weight: 600;
        color: #212529;
        overflow-wrap: anywhere;
    }

    .pending-status {
        background: #fff3cd;
        color: #856404;
    }

    .refunded-status {
        background: #d4edda;
        color: #155724;
    }

    .refund-status {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        display: inline-block;
    }
</style>

<div class="refund-detail-card">

    <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
        <h5>Refund Details #{{ $refund->id }}</h5>

        <a href="{{ url('manage_refunds') }}"
           class="btn btn-secondary btn-sm">
            <i class="fa fa-arrow-left"></i> Back
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

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
                <div class="refund-label">Invoice Number</div>
                <div class="refund-value">
                    {{ $refund->invoice_number ?? 'N/A' }}
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="refund-detail-row">
                <div class="refund-label">Customer Name</div>
                <div class="refund-value">
                    {{ $refund->customer_name ?? 'N/A' }}
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="refund-detail-row">
                <div class="refund-label">Sale Date</div>
                <div class="refund-value">
                    {{ $refund->purchase_date ?? 'N/A' }}
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="refund-detail-row">
                <div class="refund-label">Original Sale Amount</div>
                <div class="refund-value">
                    ₹{{ number_format((float) ($refund->grand_total ?? 0), 2) }}
                </div>
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
                        <span class="refund-status pending-status">Pending</span>
                    @else
                        <span class="refund-status refunded-status">
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

    @if($refund->refund_status == 'Pending')
        <div class="mt-4">
            <a href="{{ url('process_refund/' . $refund->id) }}"
               class="btn btn-success">
                <i class="fa fa-money-bill"></i> Process Refund
            </a>
        </div>
    @endif

</div>

@endsection