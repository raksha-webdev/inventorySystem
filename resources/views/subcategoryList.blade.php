@extends('admin_master')

@section('content')

<div class="main-body">
    <div class="page-wrapper">


    <!-- Page-header start -->
    <div class="page-header card">
        <div class="row align-items-end">

            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="icofont icofont-file-code bg-c-blue"></i>

                    <div class="d-inline">
                        <h4>Sub Category List</h4>
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
                            <a href="{{ url('/') }}">Dashboard</a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="{{ url('sub_categorydata') }}">
                                Sub Category
                            </a>
                        </li>

                    </ul>

                </div>
            </div>

        </div>
    </div>
    <!-- Page-header end -->


    <div class="page-body">

        <div class="row">

            <div class="col-sm-12">

                <!-- Success message -->
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Error message -->
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Validation errors -->
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
                <!-- ADD / EDIT SUB CATEGORY FORM -->
                <!-- ================================================= -->

                <div class="card">

                    <div class="toggle-panel @if(isset($id) && $id !== null) open @endif"
                         id="subCategoryFormPanel">

                        <div class="toggle-form-inner">

                            <div class="d-flex justify-content-between align-items-center mb-2">

                                <h4 class="sub-title" id="subCategoryFormTitle">

                                    @if(isset($id) && $id != '0' && isset($sub_cat_data_single))
                                        Update Sub Category
                                    @else
                                        Add Sub Category
                                    @endif

                                </h4>

                                <button type="button"
                                        class="btn-close-form"
                                        onclick="closeSubCategoryForm()">
                                    &times;
                                </button>

                            </div>


                            <!-- FORM -->

                            <form id="subCategoryForm"
                                  action="{{ url('add_subcategory') }}"
                                  method="POST">

                                @csrf


                                <!-- Category -->

                                <div class="form-group row">

                                    <label class="col-sm-2 col-form-label">
                                        Category
                                    </label>

                                    <div class="col-sm-10">

                                        <select name="cat_id"
                                                id="sub_cat_id"
                                                class="form-control">

                                            <option value="">
                                                Select Category
                                            </option>

                                            @foreach($cat_data as $category)

                                                <option value="{{ $category->id }}"

                                                    @if(
                                                        old(
                                                            'cat_id',
                                                            isset($sub_cat_data_single)
                                                                ? $sub_cat_data_single->cat_id
                                                                : ''
                                                        ) == $category->id
                                                    )
                                                        selected
                                                    @endif>

                                                    {{ $category->cat_name }}

                                                </option>

                                            @endforeach

                                        </select>

                                    </div>

                                </div>


                                <!-- Sub Category Name -->

                                <div class="form-group row">

                                    <label class="col-sm-2 col-form-label">
                                        Sub Category Name
                                    </label>

                                    <div class="col-sm-10">

                                        <input type="text"
                                               class="form-control"
                                               name="name"
                                               id="sub_category_name"
                                               value="{{ old('name', isset($sub_cat_data_single) ? $sub_cat_data_single->name : '') }}">

                                    </div>

                                </div>


                                <!-- Status -->

                                <div class="form-group row">

                                    <label class="col-sm-2 col-form-label">
                                        Status
                                    </label>

                                    <div class="col-sm-10">

                                        <select name="status"
                                                id="sub_category_status"
                                                class="form-control">

                                            <option value="">
                                                Select
                                            </option>

                                            <option value="1"
                                                {{ old(
                                                    'status',
                                                    isset($sub_cat_data_single)
                                                        ? $sub_cat_data_single->status
                                                        : ''
                                                ) == '1' ? 'selected' : '' }}>

                                                Active

                                            </option>

                                            <option value="0"
                                                {{ old(
                                                    'status',
                                                    isset($sub_cat_data_single)
                                                        ? $sub_cat_data_single->status
                                                        : ''
                                                ) == '0' ? 'selected' : '' }}>

                                                Deactive

                                            </option>

                                        </select>

                                    </div>

                                </div>


                                <!-- Buttons -->

                                <div>

                                    <button type="submit"
                                            class="btn btn-primary"
                                            id="subCategoryFormSubmitBtn">

                                        @if(isset($id) && $id != '0' && isset($sub_cat_data_single))
                                            Update
                                        @else
                                            Add
                                        @endif

                                    </button>


                                    <button type="button"
                                            class="btn btn-secondary"
                                            onclick="closeSubCategoryForm()">

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
    <!-- SUB CATEGORY TABLE -->
    <!-- ================================================= -->

    <div class="page-body">

        <div class="row">

            <div class="col-sm-12">

                <div class="category-card">

                    <div class="category-card-header">

                        <div>

                            <h4>Sub Categories</h4>

                            <p>Manage all your sub categories</p>

                        </div>


                        <button type="button"
                                class="add-category-btn"
                                onclick="openAddSubCategoryForm()">

                            <i class="fa fa-plus"></i>

                            Add Sub Category

                        </button>

                    </div>


                    <div class="category-table-wrapper">

                        <table class="category-table">

                            <thead>

                                <tr>

                                    <th width="70">
                                        #
                                    </th>

                                    <th>
                                        Category
                                    </th>

                                    <th>
                                        Sub Category Name
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

                                @forelse($sub_cat_data as $key => $sub_category)

                                    <tr>

                                        <!-- Serial number -->

                                        <td>

                                            <span class="serial-number">
                                                {{ $key + 1 }}
                                            </span>

                                        </td>


                                        <!-- Category Name -->

                                        <td>

                                            <span class="category-name">

                                                {{ $sub_category->cat_name ?? 'N/A' }}

                                            </span>

                                        </td>


                                        <!-- Sub Category Name -->

                                        <td>

                                            <span class="category-name">

                                                {{ $sub_category->name }}

                                            </span>

                                        </td>


                                        <!-- Status -->

                                        <td>

                                            @if($sub_category->status == '1')

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


                                        <!-- Added Date Time -->

                                        <td>

                                            {{ $sub_category->added_date_time }}

                                        </td>


                                        <!-- Actions -->

                                        <td>

                                            <div class="action-buttons">


                                                <!-- EDIT -->

                                                <button type="button"
                                                        class="action-btn edit-btn"
                                                        title="Edit Sub Category"

                                                        onclick="openEditSubCategoryForm(
                                                            '{{ $sub_category->id }}',
                                                            '{{ $sub_category->cat_id }}',
                                                            '{{ addslashes($sub_category->name) }}',
                                                            '{{ $sub_category->status }}'
                                                        )">

                                                    <i class="fa fa-pencil"></i>

                                                </button>


                                                <!-- DELETE -->

                                                <form action="{{ url('subcategory_delete/'.$sub_category->id) }}"
                                                      method="get"
                                                      onsubmit="return confirm('Are you sure you want to delete this sub category?');"
                                                      style="display:inline;">

                                                    @csrf

                                                    <button type="submit"
                                                            class="action-btn delete-btn"
                                                            title="Delete Sub Category">

                                                        <i class="fa fa-trash"></i>

                                                    </button>

                                                </form>

                                            </div>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="6"
                                            class="empty-category">

                                            <i class="fa fa-folder-open"></i>

                                            <strong>
                                                No Sub Categories Found
                                            </strong>

                                            <span>
                                                Add your first sub category to get started.
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

<!-- SUB CATEGORY SCRIPT -->

<!-- ================================================= -->

<script>

    const subCategoryFormPanel =
        document.getElementById('subCategoryFormPanel');

    const subCategoryForm =
        document.getElementById('subCategoryForm');

    const subCategoryFormTitle =
        document.getElementById('subCategoryFormTitle');

    const subCategoryFormSubmit =
        document.getElementById('subCategoryFormSubmitBtn');

    const subCategoryIdInput =
        document.getElementById('sub_cat_id');

    const subCategoryNameInput =
        document.getElementById('sub_category_name');

    const subCategoryStatusInput =
        document.getElementById('sub_category_status');


    // =====================================================
    // ADD SUB CATEGORY
    // =====================================================

    function openAddSubCategoryForm()
    {
        subCategoryForm.reset();

        subCategoryForm.action =
            "{{ url('add_subcategory') }}";

        subCategoryFormTitle.textContent =
            "Add Sub Category";

        subCategoryFormSubmit.textContent =
            "Add";

        slideOpen(subCategoryFormPanel);

        subCategoryFormPanel.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    }


    // =====================================================
    // EDIT SUB CATEGORY
    // =====================================================

    function openEditSubCategoryForm(
        id,
        catId,
        name,
        status
    )
    {
        subCategoryForm.reset();

        /*
         * ID is passed through URL.
         */

        subCategoryForm.action =
            "{{ url('add_subcategory') }}/" + id;


        console.log("Sub Category ID:", id);

        console.log(
            "Category ID:",
            catId
        );

        console.log(
            "Form Action:",
            subCategoryForm.action
        );


        subCategoryFormTitle.textContent =
            "Update Sub Category";

        subCategoryFormSubmit.textContent =
            "Update";


        /*
         * Select category.
         */

        subCategoryIdInput.value =
            catId;


        /*
         * Set sub category name.
         */

        subCategoryNameInput.value =
            name;


        /*
         * Set status.
         */

        subCategoryStatusInput.value =
            status;


        slideOpen(subCategoryFormPanel);

        subCategoryFormPanel.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    }


    // =====================================================
    // CLOSE FORM
    // =====================================================

    function closeSubCategoryForm()
    {
        slideClose(subCategoryFormPanel);
    }

</script>

@endsection
