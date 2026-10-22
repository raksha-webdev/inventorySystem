
@extends('admin_master')

@section('title', 'Sale Refunds')

@section('heading', 'Sale Refunds')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">
        Sale Refunds
    </li>
@endsection

@section('content')

<style>
    .refund-page {
        padding: 8px 4px 25px;
        color: #263247;
    }

    .refund-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 14px;
        margin-bottom: 24px;
    }

    .refund-header h3 {
        margin: 0 0 6px;
        font-size: 23px;
        font-weight: 700;
        color: #1e293b;
    }

    .refund-header p {
        margin: 0;
        font-size: 13px;
        color: #718096;
    }

    .refund-back-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 15px;
        border: 1px solid #dbe3ef;
        border-radius: 9px;
        background: #fff;
        color: #334155;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
    }

    .refund-back-btn:hover {
        background: #f1f5f9;
        color: #3156c9;
        text-decoration: none;
    }

    .refund-summary {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 16px;
        margin-bottom: 24px;
    }

    .refund-summary-card {
        display: flex;
        align-items: center;
        gap: 13px;
        min-width: 0;
        padding: 20px;
        border: 1px solid #e6ebf2;
        border-radius: 14px;
        background: #fff;
        box-shadow: 0 4px 18px rgba(15, 23, 42, .035);
    }

    .refund-summary-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 46px;
        height: 46px;
        min-width: 46px;
        border-radius: 12px;
        font-size: 19px;
    }

    .refund-summary-icon.total {
        background: #e8efff;
        color: #4169e2;
    }

    .refund-summary-icon.pending {
        background: #fff3dc;
        color: #d97706;
    }

    .refund-summary-icon.processed {
        background: #dcfce7;
        color: #15803d;
    }

    .refund-summary-icon.amount {
        background: #f3e8ff;
        color: #7e22ce;
    }

    .refund-summary-label {
        display: block;
        margin-bottom: 6px;
        color: #718096;
        font-size: 12px;
        font-weight: 600;
    }

    .refund-summary-value {
        display: block;
        color: #1e293b;
        font-size: 21px;
        font-weight: 750;
        overflow-wrap: anywhere;
    }

    .refund-table-card {
        overflow: hidden;
        border: 1px solid #e6ebf2;
        border-radius: 15px;
        background: #fff;
        box-shadow: 0 4px 18px rgba(15, 23, 42, .04);
    }

    .refund-table-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        padding: 21px 22px;
        border-bottom: 1px solid #edf0f5;
    }

    .refund-table-header h4 {
        margin: 0 0 5px;
        color: #1e293b;
        font-size: 17px;
        font-weight: 700;
    }

    .refund-table-header p {
        margin: 0;
        color: #718096;
        font-size: 12px;
    }

    .refund-count {
        padding: 7px 12px;
        border-radius: 20px;
        background: #e8efff;
        color: #3156c9;
        font-size: 12px;
        font-weight: 700;
    }

    .refund-table-wrap {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .refund-table {
        width: 100%;
        min-width: 1120px;
        margin: 0;
        border-collapse: collapse;
    }

    .refund-table thead th {
        padding: 15px;
        background: #f8fafc;
        color: #64748b;
        border-bottom: 1px solid #e6ebf2;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .4px;
        text-transform: uppercase;
        white-space: nowrap;
    }

    .refund-table tbody td {
        padding: 16px 15px;
        border-bottom: 1px solid #edf0f5;
        color: #475569;
        font-size: 13px;
        vertical-align: middle;
    }

    .refund-table tbody tr:last-child td {
        border-bottom: 0;
    }

    .refund-table tbody tr:hover {
        background: #fafcff;
    }

    .refund-invoice {
        color: #3156c9;
        font-weight: 700;
        white-space: nowrap;
    }

    .refund-customer {
        color: #1e293b;
        font-weight: 600;
    }

    .refund-amount {
        color: #059669;
        font-weight: 700;
        white-space: nowrap;
    }

    .refund-method {
        display: inline-block;
        padding: 5px 9px;
        border-radius: 6px;
        background: #f1f5f9;
        color: #475569;
        font-size: 11px;
        font-weight: 700;
    }

    .refund-status {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        white-space: nowrap;
        text-transform: capitalize;
    }

    .refund-status.pending {
        background: #fff3dc;
        color: #a16207;
    }

    .refund-status.processed {
        background: #dcfce7;
        color: #166534;
    }

    .refund-status.failed {
        background: #fee2e2;
        color: #b91c1c;
    }

    .refund-status.not_applicable {
        background: #f1f5f9;
        color: #475569;
    }

    .refund-status.other {
        background: #e8efff;
        color: #3156c9;
    }

    .refund-empty {
        padding: 50px 20px !important;
        text-align: center;
    }

    .refund-empty i {
        display: block;
        margin-bottom: 13px;
        color: #94a3b8;
        font-size: 36px;
    }

    .refund-empty h5 {
        margin-bottom: 7px;
        color: #334155;
        font-weight: 700;
    }

    .refund-empty p {
        margin: 0;
        color: #94a3b8;
        font-size: 13px;
    }

    .refund-footer {
        padding: 15px 22px;
        border-top: 1px solid #edf0f5;
        color: #64748b;
        font-size: 12px;
    }

    @media (max-width: 1200px) {
        .refund-summary {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 576px) {
        .refund-page {
            padding: 5px 0 18px;
        }

        .refund-header h3 {
            font-size: 20px;
        }

        .refund-summary {
            grid-template-columns: 1fr;
            gap: 12px;
        }

        .refund-summary-card {
            padding: 16px;
        }

        .refund-table-header {
            padding: 17px;
        }

        .refund-footer {
            padding: 14px 17px;
        }
    }
</style>

<div class="refund-page">

    {{-- PAGE HEADER --}}
    <div class="refund-header">
        <div>
            <h3>Sale Refund Management</h3>
            <p>Track customer refunds and their payment status.</p>
        </div>

        <a href="{{ url('get_sales') }}" class="refund-back-btn">
            <i class="fa fa-arrow-left"></i>
            Back to Sales
        </a>
    </div>

    {{-- SUMMARY CARDS --}}
    <div class="refund-summary">

        <div class="refund-summary-card">
            <div class="refund-summary-icon total">
                <i class="fa fa-receipt"></i>
            </div>
            <div>
                <span class="refund-summary-label">Total Refund Records</span>
                <span class="refund-summary-value">
                    {{ number_format($total_refunds) }}
                </span>
            </div>
        </div>

        <div class="refund-summary-card">
            <div class="refund-summary-icon pending">
                <i class="fa fa-clock"></i>
            </div>
            <div>
                <span class="refund-summary-label">Pending Refunds</span>
                <span class="refund-summary-value">
                    {{ number_format($pending_refunds) }}
                </span>
            </div>
        </div>

        <div class="refund-summary-card">
            <div class="refund-summary-icon processed">
                <i class="fa fa-circle-check"></i>
            </div>
            <div>
                <span class="refund-summary-label">Processed Refunds</span>
                <span class="refund-summary-value">
                    {{ number_format($processed_refunds) }}
                </span>
            </div>
        </div>

        <div class="refund-summary-card">
            <div class="refund-summary-icon amount">
                <i class="fa fa-indian-rupee-sign"></i>
            </div>
            <div>
                <span class="refund-summary-label">Amount Refunded</span>
                <span class="refund-summary-value">
                    ₹{{ number_format((float) $total_refund_amount, 2) }}
                </span>
            </div>
        </div>

    </div>

    {{-- REFUND TABLE --}}
    <div class="refund-table-card">

        <div class="refund-table-header">
            <div>
                <h4>Refund Transactions</h4>
                <p>Review refund details for each sales invoice.</p>
            </div>

            <span class="refund-count">
                {{ $total_refunds }}
                {{ $total_refunds === 1 ? 'Record' : 'Records' }}
            </span>
        </div>

        <div class="refund-table-wrap">
            <table class="refund-table">

                <thead>
                    <tr>
                        <th>#</th>
                        <th>Invoice Number</th>
                        <th>Customer</th>
                        <th>Refund Amount</th>
                        <th>Method</th>
                        <th>Status</th>
                        <th>Transaction Reference</th>
                        <th>Reason</th>
                        <th>Processed At</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($refunds as $refund)
                        @php
                            $status = strtolower($refund->refund_status ?? 'pending');

                            $statusClass = in_array(
                                $status,
                                ['pending', 'processed', 'failed', 'not_applicable']
                            ) ? $status : 'other';
                        @endphp

                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>
                                <span class="refund-invoice">
                                    {{ $refund->invoice_number ?? 'N/A' }}
                                </span>
                            </td>

                            <td>
                                <div class="refund-customer">
                                    {{ $refund->customer_name ?? 'N/A' }}
                                </div>

                                @if(!empty($refund->customer_phone))
                                    <small class="text-muted">
                                        {{ $refund->customer_phone }}
                                    </small>
                                @endif
                            </td>

                            <td>
                                <span class="refund-amount">
                                    ₹{{ number_format((float) $refund->refund_amount, 2) }}
                                </span>
                            </td>

                            <td>
                                <span class="refund-method">
                                    {{ strtoupper($refund->refund_method ?? 'N/A') }}
                                </span>
                            </td>

                            <td>
                                <span class="refund-status {{ $statusClass }}">
                                    {{ str_replace('_', ' ', $status) }}
                                </span>
                            </td>

                            <td>
                                {{ $refund->transaction_reference ?: '—' }}
                            </td>

                            <td>
                                {{ $refund->refund_reason ?: '—' }}
                            </td>

                            <td>
                                @if($refund->processed_at)
                                    {{ \Carbon\Carbon::parse($refund->processed_at)->format('d M Y, h:i A') }}
                                @else
                                    —
                                @endif
                            </td>

                            <td>
                                <a href="{{ url('view_sale/'.$refund->id) }}" class="btn btn-sm btn-info">View</a>
                                <button class="btn btn-sm btn-secondary">Process Refund</button>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="9" class="refund-empty">
                                <i class="fa fa-receipt"></i>
                                <h5>No Refund Records Found</h5>
                                <p>
                                    Refund records will appear here after they are created.
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        <div class="refund-footer">
            Showing {{ $total_refunds }}
            {{ $total_refunds === 1 ? 'refund record' : 'refund records' }}
        </div>

    </div>

</div>

@endsection
