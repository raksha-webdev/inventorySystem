@extends('admin_master')

@section('content')

<style>
    .table th,
    .table td {
        white-space: nowrap;
        vertical-align: middle;
    }

    .form-label {
        font-weight: 500;
    }

    .table-responsive {
        overflow-x: auto;
    }

    .badge {
        padding: 6px 10px;
        font-size: 12px;
    }

    /* ================= SUPPLIER FORM ================= */

    .supplier-form-card {
        display: none;
        margin-bottom: 20px;
    }

    .supplier-form-card.open {
        display: block;
    }

    .supplier-form-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 20px;
        background: #4169E2;
        color: #fff;
    }

    .supplier-form-header h5 {
        margin: 0;
        color: #fff;
    }

    .btn-close-form {
        border: none;
        background: transparent;
        color: #fff;
        font-size: 28px;
        line-height: 1;
        cursor: pointer;
        padding: 0;
    }

    .btn-close-form:hover {
        opacity: 0.8;
    }

    .supplier-form-body {
        padding: 20px;
    }
</style>


<div class="main-body">
    <div class="page-wrapper">

        <!-- ================= PAGE HEADER ================= -->

        <div class="page-header card">

            <div class="row align-items-end">

                <div class="col-lg-8">

                    <div class="page-header-title">

                        <i class="feather icon-users bg-c-blue"></i>

                        <div class="d-inline">

                            <h5>Supplier Management</h5>

                            <span>Manage all suppliers</span>

                        </div>

                    </div>

                </div>

                <div class="col-lg-4">

                    <div class="page-header-breadcrumb">

                        <ul class="breadcrumb-title">
                            <li class="breadcrumb-item">
                                <a href="{{ url('/') }}">
                                    <i class="feather icon-home"></i>
                                </a>
                            </li>

                            <li class="breadcrumb-item">
                           <a href="{{ url('/') }}">
                             Dashboard
                            </a>
                        </li>

                            <li class="breadcrumb-item">
                                <a href="javascript:void(0)">
                                    Supplier
                                </a>
                            </li>

                        </ul>

                    </div>

                </div>

            </div>

        </div>


        <!-- ================= SUCCESS MESSAGE ================= -->

        @if(session('success'))

            <div class="alert alert-success">

                {{ session('success') }}

            </div>

        @endif


        <!-- ================= ERROR MESSAGE ================= -->

        @if(session('error'))

            <div class="alert alert-danger">

                {{ session('error') }}

            </div>

        @endif


        <!-- ================= VALIDATION ERRORS ================= -->

        @if($errors->any())

            <div class="alert alert-danger">

                <ul class="mb-0">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif


        <!-- ===================================================== -->
        <!--                ADD / UPDATE SUPPLIER FORM             -->
        <!-- ===================================================== -->

        <div class="card supplier-form-card
            @if(isset($supplier_single) && $supplier_single)
                open
            @endif"
            id="supplierFormPanel">

            <!-- ================= FORM HEADER ================= -->

            <div class="supplier-form-header">

                <h5 id="supplierFormTitle">

                    @if(isset($supplier_single) && $supplier_single)

                        Update Supplier

                    @else

                        Add Supplier

                    @endif

                </h5>

                <button type="button"
                        class="btn-close-form"
                        onclick="closeSupplierForm()">

                    &times;

                </button>

            </div>


            <!-- ================= FORM BODY ================= -->

            <div class="supplier-form-body">

                <form id="supplierForm"
                      method="POST"
                      action="{{ url('add_updateSupplier') }}">

                    @csrf


                    <!-- SUPPLIER ID -->

                    <input type="hidden"
                           name="supplier_id"
                           id="supplier_id"
                           value="{{ old('supplier_id',
                                isset($supplier_single)
                                ? $supplier_single->id
                                : '') }}">


                    <div class="row">


                        <!-- ================= SUPPLIER CODE ================= -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Supplier Code

                            </label>

                            <input type="text"
                                   name="supplier_code"
                                   id="supplier_code"
                                   class="form-control"
                                   value="{{ old('supplier_code',
                                        isset($supplier_single)
                                        ? $supplier_single->supplier_code
                                        : '') }}"
                                   placeholder="Enter supplier code">

                            @error('supplier_code')

                                <span class="text-danger">

                                    {{ $message }}

                                </span>

                            @enderror

                        </div>


                        <!-- ================= SUPPLIER NAME ================= -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Supplier Name
                                <span class="text-danger">*</span>

                            </label>

                            <input type="text"
                                   name="supplier_name"
                                   id="supplier_name"
                                   class="form-control"
                                   value="{{ old('supplier_name',
                                        isset($supplier_single)
                                        ? $supplier_single->supplier_name
                                        : '') }}"
                                   placeholder="Enter supplier name"
                                   required>

                            @error('supplier_name')

                                <span class="text-danger">

                                    {{ $message }}

                                </span>

                            @enderror

                        </div>


                        <!-- ================= EMAIL ================= -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Email

                            </label>

                            <input type="email"
                                   name="email"
                                   id="email"
                                   class="form-control"
                                   value="{{ old('email',
                                        isset($supplier_single)
                                        ? $supplier_single->email
                                        : '') }}"
                                   placeholder="Enter email">

                            @error('email')

                                <span class="text-danger">

                                    {{ $message }}

                                </span>

                            @enderror

                        </div>


                        <!-- ================= CONTACT PERSON ================= -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Contact Person

                            </label>

                            <input type="text"
                                   name="contact_person"
                                   id="contact_person"
                                   class="form-control"
                                   value="{{ old('contact_person',
                                        isset($supplier_single)
                                        ? $supplier_single->contact_person
                                        : '') }}"
                                   placeholder="Enter contact person">

                            @error('contact_person')

                                <span class="text-danger">

                                    {{ $message }}

                                </span>

                            @enderror

                        </div>


                        <!-- ================= PHONE ================= -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Phone

                            </label>

                            <input type="text"
                                   name="phone"
                                   id="phone"
                                   class="form-control"
                                   value="{{ old('phone',
                                        isset($supplier_single)
                                        ? $supplier_single->phone
                                        : '') }}"
                                   placeholder="Enter phone number">

                            @error('phone')

                                <span class="text-danger">

                                    {{ $message }}

                                </span>

                            @enderror

                        </div>


                        <!-- ================= ALTERNATE PHONE ================= -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Alternate Phone

                            </label>

                            <input type="text"
                                   name="alternate_phone"
                                   id="alternate_phone"
                                   class="form-control"
                                   value="{{ old('alternate_phone',
                                        isset($supplier_single)
                                        ? $supplier_single->alternate_phone
                                        : '') }}"
                                   placeholder="Enter alternate phone">

                            @error('alternate_phone')

                                <span class="text-danger">

                                    {{ $message }}

                                </span>

                            @enderror

                        </div>


                        <!-- ================= GST NUMBER ================= -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                GST Number

                            </label>

                            <input type="text"
                                   name="gst_number"
                                   id="gst_number"
                                   class="form-control"
                                   value="{{ old('gst_number',
                                        isset($supplier_single)
                                        ? $supplier_single->gst_number
                                        : '') }}"
                                   placeholder="Enter GST number">

                            @error('gst_number')

                                <span class="text-danger">

                                    {{ $message }}

                                </span>

                            @enderror

                        </div>


                        <!-- ================= CITY ================= -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                City

                            </label>

                            <input type="text"
                                   name="city"
                                   id="city"
                                   class="form-control"
                                   value="{{ old('city',
                                        isset($supplier_single)
                                        ? $supplier_single->city
                                        : '') }}"
                                   placeholder="Enter city">

                            @error('city')

                                <span class="text-danger">

                                    {{ $message }}

                                </span>

                            @enderror

                        </div>


                        <!-- ================= STATE ================= -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                State

                            </label>

                            <input type="text"
                                   name="state"
                                   id="state"
                                   class="form-control"
                                   value="{{ old('state',
                                        isset($supplier_single)
                                        ? $supplier_single->state
                                        : '') }}"
                                   placeholder="Enter state">

                            @error('state')

                                <span class="text-danger">

                                    {{ $message }}

                                </span>

                            @enderror

                        </div>


                        <!-- ================= PIN CODE ================= -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                PIN Code

                            </label>

                            <input type="text"
                                   name="pin_code"
                                   id="pin_code"
                                   class="form-control"
                                   value="{{ old('pin_code',
                                        isset($supplier_single)
                                        ? $supplier_single->pin_code
                                        : '') }}"
                                   placeholder="Enter PIN code">

                            @error('pin_code')

                                <span class="text-danger">

                                    {{ $message }}

                                </span>

                            @enderror

                        </div>


                        <!-- ================= WEBSITE ================= -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Website

                            </label>

                            <input type="text"
                                   name="website"
                                   id="website"
                                   class="form-control"
                                   value="{{ old('website',
                                        isset($supplier_single)
                                        ? $supplier_single->website
                                        : '') }}"
                                   placeholder="Enter website">

                            @error('website')

                                <span class="text-danger">

                                    {{ $message }}

                                </span>

                            @enderror

                        </div>


                        <!-- ================= STATUS ================= -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Status
                                <span class="text-danger">*</span>

                            </label>

                            <select name="status"
                                    id="status"
                                    class="form-control"
                                    required>

                                <option value="">
                                    Select Status
                                </option>

                                <option value="1"
                                    {{ old(
                                        'status',
                                        isset($supplier_single)
                                        ? $supplier_single->status
                                        : ''
                                    ) == '1' ? 'selected' : '' }}>

                                    Active

                                </option>

                                <option value="0"
                                    {{ old(
                                        'status',
                                        isset($supplier_single)
                                        ? $supplier_single->status
                                        : ''
                                    ) == '0' ? 'selected' : '' }}>

                                    Inactive

                                </option>

                            </select>

                            @error('status')

                                <span class="text-danger">

                                    {{ $message }}

                                </span>

                            @enderror

                        </div>


                        <!-- ================= ADDRESS ================= -->

                        <div class="col-md-12 mb-3">

                            <label class="form-label">

                                Address

                            </label>

                            <textarea name="address"
                                      id="address"
                                      class="form-control"
                                      rows="3"
                                      placeholder="Enter complete address">{{ old(
                                          'address',
                                          isset($supplier_single)
                                          ? $supplier_single->address
                                          : ''
                                      ) }}</textarea>

                            @error('address')

                                <span class="text-danger">

                                    {{ $message }}

                                </span>

                            @enderror

                        </div>


                        <!-- ================= NOTES ================= -->

                        <div class="col-md-12 mb-3">

                            <label class="form-label">

                                Notes

                            </label>

                            <textarea name="notes"
                                      id="notes"
                                      class="form-control"
                                      rows="3"
                                      placeholder="Enter notes">{{ old(
                                          'notes',
                                          isset($supplier_single)
                                          ? $supplier_single->notes
                                          : ''
                                      ) }}</textarea>

                            @error('notes')

                                <span class="text-danger">

                                    {{ $message }}

                                </span>

                            @enderror

                        </div>


                    </div>


                    <!-- ================= BUTTONS ================= -->

                    <div class="text-end">

                        <button type="submit"
                                class="btn btn-primary"
                                id="supplierFormSubmitButton">

                            <i class="fa fa-save"></i>

                            @if(isset($supplier_single) && $supplier_single)

                                Update Supplier

                            @else

                                Add Supplier

                            @endif

                        </button>


                        <button type="button"
                                class="btn btn-secondary"
                                onclick="closeSupplierForm()">

                            Cancel

                        </button>

                    </div>

                </form>

            </div>

        </div>


        <!-- ===================================================== -->
        <!--                    SUPPLIER TABLE                      -->
        <!-- ===================================================== -->

        <div class="card">

            <div class="card-header">

                <div class="row align-items-center">

                    <div class="col-md-6">

                        <h5>Supplier List</h5>

                    </div>

                    <div class="col-md-6 text-md-end mt-2 mt-md-0">

                        <button type="button"
                                class="btn btn-primary"
                                onclick="openAddSupplierForm()">

                            <i class="fa fa-plus"></i>

                            Add Supplier

                        </button>

                    </div>

                </div>

            </div>


            <div class="card-block table-border-style">

                <div class="table-responsive">

                    <table class="table table-bordered table-hover">

                        <thead>

                            <tr>

                                <th>#</th>
                                <th>Supplier Code</th>
                                <th>Supplier Name</th>
                                <th>Email</th>
                                <th>Contact Person</th>
                                <th>Phone</th>
                                <th>Alternate Phone</th>
                                <th>GST Number</th>
                                <th>City</th>
                                <th>State</th>
                                <th>PIN Code</th>
                                <th>Status</th>
                                <th>Action</th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse($suppliers as $key => $supplier)

                                <tr>

                                    <td>
                                        {{ $key + 1 }}
                                    </td>

                                    <td>
                                        {{ $supplier->supplier_code ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $supplier->supplier_name ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $supplier->email ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $supplier->contact_person ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $supplier->phone ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $supplier->alternate_phone ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $supplier->gst_number ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $supplier->city ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $supplier->state ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $supplier->pin_code ?? '-' }}
                                    </td>

                                    <td>

                                        @if($supplier->status == 1)

                                            <span class="badge bg-success">
                                                Active
                                            </span>

                                        @else

                                            <span class="badge bg-danger">
                                                Inactive
                                            </span>

                                        @endif

                                    </td>

                                    <td>

                                        <div class="d-flex gap-1">

                                            <!-- EDIT -->

                                            <button type="button"
                                                    class="btn btn-sm btn-warning"
                                                    onclick='editSupplier(@json($supplier))'
                                                    title="Edit Supplier">

                                                <i class="fa fa-edit"></i>

                                            </button>


                                            <!-- DETAILS -->

                                            <a href="{{ url('supplier_detail/'.$supplier->id) }}"
                                               class="btn btn-sm btn-info"
                                               title="View Details">

                                                <i class="fa fa-eye"></i>

                                            </a>


                                            <!-- DELETE -->

                                            <a href="{{ route('delete_supplier', $supplier->id) }}"
                                               class="btn btn-sm btn-danger"
                                               title="Delete Supplier"
                                               onclick="return confirm('Are you sure you want to delete this supplier?')">

                                                <i class="fa fa-trash"></i>

                                            </a>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="13"
                                        class="text-center">

                                        No suppliers found.

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


<!-- ===================================================== -->
<!--                       JAVASCRIPT                      -->
<!-- ===================================================== -->

<script>

    /*
    |--------------------------------------------------------------------------
    | OPEN ADD SUPPLIER FORM
    |--------------------------------------------------------------------------
    */

    function openAddSupplierForm()
    {
        let formPanel = document.getElementById('supplierFormPanel');

        let form = document.getElementById('supplierForm');

        let title = document.getElementById('supplierFormTitle');

        let submitButton =
            document.getElementById('supplierFormSubmitButton');


        /*
        |--------------------------------------------------------------------------
        | Clear form
        |--------------------------------------------------------------------------
        */

        form.reset();


        /*
        |--------------------------------------------------------------------------
        | Clear supplier ID
        |--------------------------------------------------------------------------
        */

        document.getElementById('supplier_id').value = '';


        /*
        |--------------------------------------------------------------------------
        | Change form action for ADD
        |--------------------------------------------------------------------------
        */

        form.action = "{{ url('add_updateSupplier') }}";


        /*
        |--------------------------------------------------------------------------
        | Change title
        |--------------------------------------------------------------------------
        */

        title.innerText = 'Add Supplier';


        /*
        |--------------------------------------------------------------------------
        | Change button text
        |--------------------------------------------------------------------------
        */

        submitButton.innerHTML =
            '<i class="fa fa-save"></i> Add Supplier';


        /*
        |--------------------------------------------------------------------------
        | Open form
        |--------------------------------------------------------------------------
        */

        formPanel.classList.add('open');


        /*
        |--------------------------------------------------------------------------
        | Scroll to form
        |--------------------------------------------------------------------------
        */

        formPanel.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    }


    /*
    |--------------------------------------------------------------------------
    | CLOSE SUPPLIER FORM
    |--------------------------------------------------------------------------
    */

    function closeSupplierForm()
    {
        let formPanel =
            document.getElementById('supplierFormPanel');

        formPanel.classList.remove('open');
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT SUPPLIER
    |--------------------------------------------------------------------------
    */

    function editSupplier(supplier)
    {
        let formPanel =
            document.getElementById('supplierFormPanel');

        let form =
            document.getElementById('supplierForm');

        let title =
            document.getElementById('supplierFormTitle');

        let submitButton =
            document.getElementById('supplierFormSubmitButton');


        /*
        |--------------------------------------------------------------------------
        | Set supplier ID
        |--------------------------------------------------------------------------
        */

        document.getElementById('supplier_id').value =
            supplier.id ?? '';


        /*
        |--------------------------------------------------------------------------
        | Fill form fields
        |--------------------------------------------------------------------------
        */

        document.getElementById('supplier_code').value =
            supplier.supplier_code ?? '';

        document.getElementById('supplier_name').value =
            supplier.supplier_name ?? '';

        document.getElementById('email').value =
            supplier.email ?? '';

        document.getElementById('contact_person').value =
            supplier.contact_person ?? '';

        document.getElementById('phone').value =
            supplier.phone ?? '';

        document.getElementById('alternate_phone').value =
            supplier.alternate_phone ?? '';

        document.getElementById('gst_number').value =
            supplier.gst_number ?? '';

        document.getElementById('address').value =
            supplier.address ?? '';

        document.getElementById('city').value =
            supplier.city ?? '';

        document.getElementById('state').value =
            supplier.state ?? '';

        document.getElementById('pin_code').value =
            supplier.pin_code ?? '';

        document.getElementById('website').value =
            supplier.website ?? '';

        document.getElementById('notes').value =
            supplier.notes ?? '';

        document.getElementById('status').value =
            supplier.status ?? '';


        /*
        |--------------------------------------------------------------------------
        | Change form action for UPDATE
        |--------------------------------------------------------------------------
        */

        form.action =
            "{{ url('add_updateSupplier') }}/" + supplier.id;


        /*
        |--------------------------------------------------------------------------
        | Change title
        |--------------------------------------------------------------------------
        */

        title.innerText = 'Update Supplier';


        /*
        |--------------------------------------------------------------------------
        | Change submit button
        |--------------------------------------------------------------------------
        */

        submitButton.innerHTML =
            '<i class="fa fa-save"></i> Update Supplier';


        /*
        |--------------------------------------------------------------------------
        | Open form
        |--------------------------------------------------------------------------
        */

        formPanel.classList.add('open');


        /*
        |--------------------------------------------------------------------------
        | Scroll to form
        |--------------------------------------------------------------------------
        */

        formPanel.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    }

</script>



<script>
    let notesEditor;

    document.addEventListener('DOMContentLoaded', function () {

        const notesField = document.querySelector('#notes');

        if (notesField) {

            ClassicEditor
                .create(notesField)
                .then(editor => {

                    notesEditor = editor;

                    console.log('CKEditor loaded successfully');

                })
                .catch(error => {

                    console.error('CKEditor Error:', error);

                });

        }

    });
</script>


@endsection

