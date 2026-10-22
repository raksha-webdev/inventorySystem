@extends('admin_master')

@section('content')

<style>
    .supplier-details-page {
        padding: 20px;
    }

    .supplier-header {
        background: linear-gradient(135deg, #4169E2, #3158c7);
        color: #fff;
        border-radius: 12px 12px 0 0;
        padding: 22px 25px;
    }

    .supplier-header h4 {
        margin: 0;
        font-size: 22px;
        font-weight: 600;
    }

    .supplier-header p {
        margin: 5px 0 0;
        opacity: 0.9;
        font-size: 14px;
    }

    .supplier-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 3px 15px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .section-title {
        font-size: 17px;
        font-weight: 600;
        color: #4169E2;
        border-bottom: 1px solid #e9ecef;
        padding-bottom: 10px;
        margin-bottom: 20px;
    }

    .detail-box {
        background: #f8f9fa;
        border: 1px solid #e9ecef;
        border-radius: 8px;
        padding: 13px 15px;
        height: 100%;
    }

    .detail-label {
        display: block;
        font-size: 12px;
        color: #777;
        margin-bottom: 5px;
        font-weight: 500;
        text-transform: uppercase;
    }

    .detail-value {
        display: block;
        font-size: 15px;
        color: #222;
        font-weight: 500;
        word-break: break-word;
    }

    .status-active {
        background: #d4edda;
        color: #155724;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        display: inline-block;
    }

    .status-inactive {
        background: #f8d7da;
        color: #721c24;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        display: inline-block;
    }

    .supplier-code {
        background: #fff;
        color: #4169E2;
        border: 1px solid rgba(255,255,255,0.5);
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
        display: inline-block;
        margin-top: 10px;
    }

    

    .empty-value {
        color: #999;
        font-style: italic;
    }

    .action-buttons {
        margin-top: 20px;
    }

    @media (max-width: 767px) {

        .supplier-details-page {
            padding: 10px;
        }

        .supplier-header {
            padding: 18px;
        }

        .supplier-header h4 {
            font-size: 18px;
        }

        .detail-value {
            font-size: 14px;
        }

        .section-title {
            font-size: 16px;
        }
    }
</style>

        <div class="supplier-details-page">

            <!-- ================= PAGE HEADER ================= -->

            <div class="supplier-card">

                <div class="supplier-header">

                    <div class="d-flex justify-content-between align-items-center flex-wrap">

                        <div>
                            <h4>
                                <i class="fa fa-building mr-2"></i>
                                Supplier Details
                            </h4>

                            <p>
                                Complete information about this supplier
                            </p>
                        </div>

                        <div>
                            <span class="supplier-code">
                                Supplier Code:
                                {{ $supplier_data->supplier_code ?? 'N/A' }}
                            </span>
                        </div>

                    </div>

                </div>


                <!-- ================= SUPPLIER INFORMATION ================= -->

                <div class="p-4">

                    <h5 class="section-title">
                        <i class="fa fa-user mr-2"></i>
                        Basic Information
                    </h5>

                    <div class="row">

                        <!-- ID -->
                        <div class="col-lg-3 col-md-6 mb-3">
                            <div class="detail-box">
                                <span class="detail-label">ID</span>

                                <span class="detail-value">
                                    {{ $supplier_data->id ?? 'N/A' }}
                                </span>
                            </div>
                        </div>


                        <!-- Supplier Name -->
                        <div class="col-lg-3 col-md-6 mb-3">
                            <div class="detail-box">
                                <span class="detail-label">Supplier Name</span>
                                <span class="detail-value">
                                    {{ $supplier_data->supplier_name ?? 'N/A' }}
                                </span>
                            </div>
                        </div>


                        <!-- Contact Person -->
                        <div class="col-lg-3 col-md-6 mb-3">
                            <div class="detail-box">
                                <span class="detail-label">Contact Person</span>

                                <span class="detail-value">
                                    {{ $supplier_data->contact_person ?? 'N/A' }}
                                </span>
                            </div>
                        </div>


                        <!-- Email -->
                        <div class="col-lg-3 col-md-6 mb-3">
                            <div class="detail-box">
                                <span class="detail-label">Email</span>

                                <span class="detail-value">
                                    {{ $supplier_data->email ?? 'N/A' }}
                                </span>
                            </div>
                        </div>


                        <!-- Phone -->
                        <div class="col-lg-3 col-md-6 mb-3">
                            <div class="detail-box">
                                <span class="detail-label">Phone</span>

                                <span class="detail-value">
                                    {{ $supplier_data->phone ?? 'N/A' }}
                                </span>
                            </div>
                        </div>


                        <!-- Alternate Phone -->
                        <div class="col-lg-3 col-md-6 mb-3">
                            <div class="detail-box">
                                <span class="detail-label">Alternate Phone</span>

                                <span class="detail-value">
                                    {{ $supplier_data->alternate_phone ?? 'N/A' }}
                                </span>
                            </div>
                        </div>


                        <!-- GST Number -->
                        <div class="col-lg-3 col-md-6 mb-3">
                            <div class="detail-box">
                                <span class="detail-label">GST Number</span>

                                <span class="detail-value">
                                    {{ $supplier_data->gst_number ?? 'N/A' }}
                                </span>
                            </div>
                        </div>


                        <!-- Website -->
                        <div class="col-lg-3 col-md-6 mb-3">
                            <div class="detail-box">
                                <span class="detail-label">Website</span>

                                <span class="detail-value">
                                    @if(!empty($supplier_data->website))

                                        <a href="{{ $supplier_data->website }}"
                                           target="_blank"
                                           style="color:#4169E2;">

                                            {{ $supplier_data->website }}

                                        </a>

                                    @else

                                        <span class="empty-value">
                                            Not Available
                                        </span>

                                    @endif
                                </span>
                            </div>
                        </div>

                    </div>


                    <!-- ================= ADDRESS INFORMATION ================= -->

                    <h5 class="section-title mt-4">
                        <i class="fa fa-map-marker mr-2"></i>
                        Address Information
                    </h5>

                    <div class="row">

                        <!-- Address -->
                        <div class="col-lg-6 col-md-12 mb-3">

                            <div class="detail-box">

                                <span class="detail-label">
                                    Address
                                </span>

                                <span class="detail-value">
                                    {{ $supplier_data->address ?? 'N/A' }}
                                </span>

                            </div>

                        </div>


                        <!-- City -->
                        <div class="col-lg-2 col-md-4 mb-3">

                            <div class="detail-box">

                                <span class="detail-label">
                                    City
                                </span>

                                <span class="detail-value">
                                    {{ $supplier_data->city ?? 'N/A' }}
                                </span>

                            </div>

                        </div>


                        <!-- State -->
                        <div class="col-lg-2 col-md-4 mb-3">

                            <div class="detail-box">

                                <span class="detail-label">
                                    State
                                </span>

                                <span class="detail-value">
                                    {{ $supplier_data->state ?? 'N/A' }}
                                </span>

                            </div>

                        </div>


                        <!-- Pin Code -->
                        <div class="col-lg-2 col-md-4 mb-3">

                            <div class="detail-box">

                                <span class="detail-label">
                                    Pin Code
                                </span>

                                <span class="detail-value">
                                    {{ $supplier_data->pin_code ?? 'N/A' }}
                                </span>

                            </div>

                        </div>

                    </div>


                    <!-- ================= STATUS ================= -->

                    <h5 class="section-title mt-4">
                        <i class="fa fa-info-circle mr-2"></i>
                        Supplier Status
                    </h5>

                    <div class="row">

                        <div class="col-lg-3 col-md-6 mb-3">

                            <div class="detail-box">

                                <span class="detail-label">
                                    Status
                                </span>

                                <span class="detail-value">

                                    @if($supplier_data->status == 1)

                                        <span class="status-active">
                                            <i class="fa fa-check-circle mr-1"></i>
                                            Active
                                        </span>

                                    @else

                                        <span class="status-inactive">
                                            <i class="fa fa-times-circle mr-1"></i>
                                            Inactive
                                        </span>

                                    @endif

                                </span>

                            </div>

                        </div>


                        <div class="col-lg-3 col-md-6 mb-3">

                            <div class="detail-box">

                                <span class="detail-label">
                                    Supplier Code
                                </span>

                                <span class="detail-value">
                                    {{ $supplier_data->supplier_code ?? 'N/A' }}
                                </span>

                            </div>

                        </div>

                    </div>


                    <!-- ================= NOTES ================= -->

                    <h5 class="section-title mt-4">
                        <i class="fa fa-sticky-note mr-2"></i>
                        Notes
                    </h5>

                    <div class="notes-box">

                        @if(!empty($supplier_data->notes))

                            {{ $supplier_data->notes }}

                        @else

                            <span class="empty-value">
                                No notes available.
                            </span>

                        @endif

                    </div>


                    <!-- ================= SYSTEM INFORMATION ================= -->

                    <h5 class="section-title mt-4">
                        <i class="fa fa-database mr-2"></i>
                        System Information
                    </h5>

                    <div class="row">

                        <!-- Deleted At -->
                        <div class="col-lg-4 col-md-6 mb-3">

                            <div class="detail-box">

                                <span class="detail-label">
                                    Deleted At
                                </span>

                                <span class="detail-value">

                                    @if(!empty($supplier_data->deleted_at))

                                        {{ $supplier_data->deleted_at }}

                                    @else

                                        <span class="empty-value">
                                            Not Deleted
                                        </span>

                                    @endif

                                </span>

                            </div>

                        </div>


                        <!-- Created At -->
                        <div class="col-lg-4 col-md-6 mb-3">

                            <div class="detail-box">

                                <span class="detail-label">
                                    Created At
                                </span>

                                <span class="detail-value">
                                    {{ $supplier_data->created_at ?? 'N/A' }}
                                </span>

                            </div>

                        </div>


                        <!-- Updated At -->
                        <div class="col-lg-4 col-md-6 mb-3">

                            <div class="detail-box">

                                <span class="detail-label">
                                    Updated At
                                </span>

                                <span class="detail-value">
                                    {{ $supplier_data->updated_at ?? 'N/A' }}
                                </span>

                            </div>

                        </div>

                    </div>


        
                </div>

            </div>

        </div>

@endsection

