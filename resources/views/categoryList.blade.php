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
                            <h4>Category List</h4>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="page-header-breadcrumb">
                        <ul class="breadcrumb-title">
                            <li class="breadcrumb-item">
                                <a href="{{ url('/') }}"><i class="icofont icofont-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ url('/') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ url('categorydata') }}">Category</a>
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

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

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
                    <!-- ANIMATED ADD / EDIT FORM PANEL -->
                    <!-- Open by default only if the controller passed an -->
                    <!-- $id (direct link visit). Otherwise hidden, and    -->
                    <!-- JS opens/fills it on Add/Edit click.              -->
                    <!-- ================================================= -->
                    <div class="card">
                        <div class="toggle-panel @if(isset($id) && $id !== null) open @endif" id="categoryFormPanel">
                            <div class="toggle-form-inner">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h4 class="sub-title" id="categoryFormTitle">
                                        {{ (isset($id) && $id != '0' && isset($cat_data_single)) ? 'Update Category' : 'Add Category' }}
                                    </h4>
                                    <button type="button" class="btn-close-form" onclick="closeCategoryForm()">&times;</button>
                                </div>

                                <form id="categoryForm"
      action="{{ url('AddCategory') }}"
      method="post"
      enctype="multipart/form-data">

                                    @csrf

                                    <!-- category_id decides add vs update in your controller -->
                                    <!-- <input
                                        type="hidden"
                                        name="category_id"
                                        id="category_id"
                                        value="{{ (isset($id) && $id != '0' && isset($cat_data_single)) ? $cat_data_single->id : '' }}"
                                    > -->

                                    <!-- Category Name -->
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Category name</label>
                                        <div class="col-sm-10">
                                            <input
                                                type="text"
                                                class="form-control"
                                                name="cat_name"
                                                id="cat_name"
                                                value="{{ old('cat_name', isset($cat_data_single) ? $cat_data_single->cat_name : '') }}"
                                            >
                                        </div>
                                    </div>

                                    <!-- Category Image -->
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Category Image</label>
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control" name="cat_img" id="cat_img">

                                            <img
                                                id="cat_img_preview"
                                                src="{{ isset($cat_data_single) && $cat_data_single->cat_img ? asset('assests_uploads/category_img/' . $cat_data_single->cat_img) : '' }}"
                                                alt="Category Image"
                                                style="width: 100px; height: 100px; margin-top: 10px; {{ isset($cat_data_single) && $cat_data_single->cat_img ? '' : 'display:none;' }}"
                                            >
                                        </div>
                                    </div>

                                    <!-- Status -->
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Status</label>
                                        <div class="col-sm-10">
                                            <select name="status" id="cat_status" class="form-control">
                                                <option value="">Select</option>
                                                <option value="1"
                                                    {{ old('status', isset($cat_data_single) ? $cat_data_single->status : '') == '1' ? 'selected' : '' }}>
                                                    Active
                                                </option>
                                                <option value="0"
                                                    {{ old('status', isset($cat_data_single) ? $cat_data_single->status : '') == '0' ? 'selected' : '' }}>
                                                    Deactive
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div>
                                        <button type="submit" class="btn btn-primary" id="categoryFormSubmitBtn">
                                            {{ (isset($id) && $id != '0' && isset($cat_data_single)) ? 'Update' : 'Add' }}
                                        </button>
                                        <button type="button" class="btn btn-secondary" onclick="closeCategoryForm()">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- ================================ CATEGORY TABLE ================================= -->
        <div class="page-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="category-card">

                        <div class="category-card-header">
                            <div>
                                <h4>Categories</h4>
                                <p>Manage all your categories</p>
                            </div>
                            <button type="button" class="add-category-btn" onclick="openAddCategoryForm()">
                                <i class="fa fa-plus"></i> Add Category
                            </button>
                        </div>

                        <div class="category-table-wrapper">
                            <table class="category-table">
                                <thead>
                                    <tr>
                                        <th width="70">#</th>
                                        <th width="100">Image</th>
                                        <th>Category Name</th>
                                        <th width="150">Status</th>
                                        <th width="150">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($cat_data as $key => $category)
                                        <tr>
                                            <td><span class="serial-number">{{ $key + 1 }}</span></td>

                                            <td>
                                                @if($category->cat_img)
                                                    <img src="{{ asset('assests_uploads/category_img/' . $category->cat_img) }}"
                                                         alt="{{ $category->cat_name }}" class="category-image">
                                                @else
                                                    <div class="category-image-placeholder">
                                                        <i class="fa fa-image"></i>
                                                    </div>
                                                @endif
                                            </td>

                                            <td><span class="category-name">{{ $category->cat_name }}</span></td>

                                            <td>
                                                @if($category->status == '1')
                                                    <span class="status-badge status-active">
                                                        <i class="fa fa-circle"></i> Active
                                                    </span>
                                                @else
                                                    <span class="status-badge status-inactive">
                                                        <i class="fa fa-circle"></i> Deactive
                                                    </span>
                                                @endif
                                            </td>

                                            <td>
                                                <div class="action-buttons">
                                                    <!-- EDIT: opens the same panel via JS, no page reload -->
                                                    <button type="button" class="action-btn edit-btn" title="Edit Category"
                                                        onclick="openEditCategoryForm(
                                                            '{{ $category->id }}',
                                                            '{{ addslashes($category->cat_name) }}',
                                                            '{{ $category->cat_img ? asset('assests_uploads/category_img/' . $category->cat_img) : '' }}',
                                                            '{{ $category->status }}'
                                                        )">
                                                        <i class="fa fa-pencil"></i>
                                                    </button>

                                                    <!-- DELETE -->
                                    <form action="{{ url('category_delete/'.$category->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?');" style="display:inline;">
                                                @csrf
                                             <input type="hidden" name="category_id" value="{{ $category->id }}">
                                                        <button type="submit" class="action-btn delete-btn" title="Delete Category">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="empty-category">
                                                <i class="fa fa-folder-open"></i>
                                                <strong>No Categories Found</strong>
                                                <span>Add your first category to get started.</span>
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



<!-- ================================ SCRIPT FOR TOGGLE / ANIMATION ================================= -->
<script>
    const categoryFormPanel = document.getElementById('categoryFormPanel');
const categoryForm = document.getElementById('categoryForm');
const categoryFormTitle = document.getElementById('categoryFormTitle');
const categoryFormSubmit = document.getElementById('categoryFormSubmitBtn');

const catNameInput = document.getElementById('cat_name');
const catStatusInput = document.getElementById('cat_status');
const catImgPreview = document.getElementById('cat_img_preview');


window.addEventListener('DOMContentLoaded', () => {

    if (categoryFormPanel.classList.contains('open')) {
        categoryFormPanel.style.maxHeight =
            categoryFormPanel.scrollHeight + 'px';
    }

});

// =====================================================
// ADD CATEGORY
// =====================================================

function openAddCategoryForm()
{
    categoryForm.reset();

    // IMPORTANT
    // Add request will go to /AddCategory
    categoryForm.action = "{{ url('AddCategory') }}";

    categoryFormTitle.textContent = "Add Category";
    categoryFormSubmit.textContent = "Add";

    catImgPreview.style.display = 'none';
    catImgPreview.src = '';

    slideOpen(categoryFormPanel);

    categoryFormPanel.scrollIntoView({
        behavior: 'smooth',
        block: 'start'
    });
}


// =====================================================
// EDIT CATEGORY
// =====================================================

function openEditCategoryForm(id, name, imgUrl, status)
{
    categoryForm.reset();

    // IMPORTANT
    // ID is sent through URL
    categoryForm.action = "{{ url('AddCategory') }}/" + id;

    console.log("Category ID:", id);
    console.log("Form Action:", categoryForm.action);

    categoryFormTitle.textContent = "Update Category";
    categoryFormSubmit.textContent = "Update";

    catNameInput.value = name;
    catStatusInput.value = status;

    if (imgUrl) {

        catImgPreview.src = imgUrl;
        catImgPreview.style.display = 'inline-block';

    } else {

        catImgPreview.src = '';
        catImgPreview.style.display = 'none';

    }

    slideOpen(categoryFormPanel);

    categoryFormPanel.scrollIntoView({
        behavior: 'smooth',
        block: 'start'
    });
}


function closeCategoryForm()
{
    slideClose(categoryFormPanel);
}
</script>

@endsection