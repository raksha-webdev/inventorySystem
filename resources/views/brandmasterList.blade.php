
@extends('admin_master')

@section('content')

<div class="main-body">
    <div class="page-wrapper">

        <!-- ================= PAGE HEADER ================= -->
        <div class="page-header card">
            <div class="row align-items-end">

                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="icofont icofont-brand bg-c-blue"></i>

                        <div class="d-inline">
                            <h4>Brand List</h4>
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
                                <a href="{{ url('/') }}">
                                    Dashboard
                                </a>
                            </li>

                            <li class="breadcrumb-item">
                                <a href="{{ url('brandmasterList') }}">
                                    Brand
                                </a>
                            </li>

                        </ul>

                    </div>
                </div>

            </div>
        </div>

        <!-- ================= PAGE BODY ================= -->
        <div class="page-body">

            <div class="row">

                <div class="col-sm-12">

                    <!-- SUCCESS MESSAGE -->
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- ERROR MESSAGE -->
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- VALIDATION ERRORS -->
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
                    <!-- ADD / EDIT BRAND FORM -->
                    <!-- ================================================= -->

                    <div class="card">

                        <div
                            class="toggle-panel @if(isset($brand_id) && $brand_id != '0' && isset($brand_data_single)) open @endif"
                            id="brandFormPanel"
                        >

                            <div class="toggle-form-inner">

                                <div class="d-flex justify-content-between align-items-center mb-2">

                                    <h4
                                        class="sub-title"
                                        id="brandFormTitle"
                                    >

                                        @if(isset($brand_id) && $brand_id != '0' && isset($brand_data_single))

                                            Update Brand

                                        @else

                                            Add Brand

                                        @endif

                                    </h4>

                                    <button
                                        type="button"
                                        class="btn-close-form"
                                        onclick="closeBrandForm()"
                                    >
                                        &times;
                                    </button>

                                </div>


                                <!-- ================= FORM ================= -->

                                <form
                                    id="brandForm"
                                    action="{{ url('add_updatebrand') }}"
                                    method="POST"
                                >

                                    @csrf


                                    <!-- ================= BRAND NAME ================= -->

                                    <div class="form-group row">

                                        <label class="col-sm-2 col-form-label">
                                            Brand Name
                                        </label>

                                        <div class="col-sm-10">

                                            <input
                                                type="text"
                                                class="form-control"
                                                name="name"
                                                id="brand_name"
                                                value="{{ old('name', isset($brand_data_single) ? $brand_data_single->name : '') }}"
                                                placeholder="Enter Brand Name"
                                            >

                                        </div>

                                    </div>


                                    <!-- ================= STATUS ================= -->

                                    <div class="form-group row">

                                        <label class="col-sm-2 col-form-label">
                                            Status
                                        </label>

                                        <div class="col-sm-10">

                                            <select
                                                name="status"
                                                id="brand_status"
                                                class="form-control"
                                            >

                                                <option value="">
                                                    Select
                                                </option>

                                                <option
                                                    value="1"
                                                    {{ old(
                                                        'status',
                                                        isset($brand_data_single)
                                                            ? $brand_data_single->status
                                                            : ''
                                                    ) == '1' ? 'selected' : '' }}
                                                >
                                                    Active
                                                </option>

                                                <option
                                                    value="0"
                                                    {{ old(
                                                        'status',
                                                        isset($brand_data_single)
                                                            ? $brand_data_single->status
                                                            : ''
                                                    ) == '0' ? 'selected' : '' }}
                                                >
                                                    Deactive
                                                </option>

                                            </select>

                                        </div>

                                    </div>


                                    <!-- ================= BUTTONS ================= -->

                                    <div>

                                        <button
                                            type="submit"
                                            class="btn btn-primary"
                                            id="brandFormSubmitBtn"
                                        >

                                            @if(isset($brand_id) && $brand_id != '0' && isset($brand_data_single))

                                                Update

                                            @else

                                                Add

                                            @endif

                                        </button>


                                        <button
                                            type="button"
                                            class="btn btn-secondary"
                                            onclick="closeBrandForm()"
                                        >
                                            Cancel
                                        </button>

                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        <!-- ================================================= -->
        <!-- BRAND TABLE -->
        <!-- ================================================= -->

        <div class="page-body">

            <div class="row">

                <div class="col-sm-12">

                    <div class="category-card">


                        <!-- ================= TABLE HEADER ================= -->

                        <div class="category-card-header">

                            <div>

                                <h4>Brands</h4>

                                <p>
                                    Manage all your brands
                                </p>

                            </div>


                            <button
                                type="button"
                                class="add-category-btn"
                                onclick="openAddBrandForm()"
                            >

                                <i class="fa fa-plus"></i>

                                Add Brand

                            </button>

                        </div>


                        <!-- ================= TABLE ================= -->

                        <div class="category-table-wrapper">

                            <table class="category-table">

                                <thead>

                                    <tr>

                                        <th width="70">
                                            #
                                        </th>

                                        <th>
                                            Brand Name
                                        </th>

                                        <th width="150">
                                            Status
                                        </th>

                                        <th width="180">
                                            Added Date & Time
                                        </th>

                                        <th width="150">
                                            Actions
                                        </th>

                                    </tr>

                                </thead>


                                <tbody>

                                    @forelse($brand_data as $key => $brand)

                                        <tr>

                                            <!-- SERIAL NUMBER -->

                                            <td>

                                                <span class="serial-number">
                                                    {{ $key + 1 }}
                                                </span>

                                            </td>


                                            <!-- BRAND NAME -->

                                            <td>

                                                <span class="category-name">
                                                    {{ $brand->name }}
                                                </span>

                                            </td>


                                            <!-- STATUS -->

                                            <td>

                                                @if($brand->status == '1')

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


                                            <!-- DATE & TIME -->

                                            <td>

                                                {{ $brand->added_date_time }}

                                            </td>


                                            <!-- ACTIONS -->

                                            <td>

                                                <div class="action-buttons">


                                                    <!-- EDIT -->

                                                    <button
                                                        type="button"
                                                        class="action-btn edit-btn"
                                                        title="Edit Brand"
                                                        onclick="openEditBrandForm(
                                                            '{{ $brand->id }}',
                                                            '{{ addslashes($brand->name) }}',
                                                            '{{ $brand->status }}'
                                                        )"
                                                    >

                                                        <i class="fa fa-pencil"></i>

                                                    </button>


                                                    <!-- DELETE -->

                                                    <form
                                                        action="{{ url('brand_delete/'.$brand->id) }}"
                                                        method="get"
                                                        onsubmit="return confirm('Are you sure you want to delete this brand?');"
                                                        style="display:inline;"
                                                    >

                                                        @csrf

                                                        <button
                                                            type="submit"
                                                            class="action-btn delete-btn"
                                                            title="Delete Brand"
                                                        >

                                                            <i class="fa fa-trash"></i>

                                                        </button>

                                                    </form>

                                                </div>

                                            </td>

                                        </tr>

                                    @empty

                                        <tr>

                                            <td
                                                colspan="5"
                                                class="empty-category"
                                            >

                                                <i class="fa fa-folder-open"></i>

                                                <strong>
                                                    No Brands Found
                                                </strong>

                                                <span>
                                                    Add your first brand to get started.
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

</div>


<!-- ================================================= -->
<!-- BRAND SCRIPT -->
<!-- ================================================= -->

<script>

    const brandFormPanel =
        document.getElementById('brandFormPanel');

    const brandForm =
        document.getElementById('brandForm');

    const brandFormTitle =
        document.getElementById('brandFormTitle');

    const brandFormSubmit =
        document.getElementById('brandFormSubmitBtn');

    const brandNameInput =
        document.getElementById('brand_name');

    const brandStatusInput =
        document.getElementById('brand_status');


    // =====================================================
    // ADD BRAND
    // =====================================================

    function openAddBrandForm()
    {

        brandForm.reset();

        brandForm.action =
            "{{ url('add_updatebrand') }}";

        brandFormTitle.textContent =
            "Add Brand";

        brandFormSubmit.textContent =
            "Add";

        slideOpen(brandFormPanel);

        brandFormPanel.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });

    }


    // =====================================================
    // EDIT BRAND
    // =====================================================

    function openEditBrandForm(
        id,
        name,
        status
    )
    {

        brandForm.reset();


        // ID is passed through URL

        brandForm.action =
            "{{ url('add_updatebrand') }}/" + id;


        console.log("Brand ID:", id);

        console.log(
            "Brand Name:",
            name
        );

        console.log(
            "Brand Status:",
            status
        );

        console.log(
            "Form Action:",
            brandForm.action
        );


        // Change heading

        brandFormTitle.textContent =
            "Update Brand";


        // Change button

        brandFormSubmit.textContent =
            "Update";


        // Set brand name

        brandNameInput.value =
            name;


        // Set status

        brandStatusInput.value =
            status;


        // Open form

        slideOpen(brandFormPanel);

        brandFormPanel.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });

    }


    // =====================================================
    // CLOSE FORM
    // =====================================================

    function closeBrandForm()
    {

        slideClose(brandFormPanel);

    }

</script>

@endsection

