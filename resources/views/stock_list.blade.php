
@extends('admin_master')

@section('content')

<div class="main-body">
    <div class="page-wrapper">

        <!-- ============================================= -->
        <!-- PAGE HEADER -->
        <!-- ============================================= -->

        <div class="page-header card">

            <div class="row align-items-end">

                <div class="col-lg-8">

                    <div class="page-header-title">

                        <i class="icofont icofont-stock bg-c-blue"></i>

                        <div class="d-inline">

                            <h4>Stock List</h4>

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

                                <a href="{{ url('stock_list') }}">
                                    Stock List
                                </a>

                            </li>

                        </ul>

                    </div>

                </div>

            </div>

        </div>


        <!-- ============================================= -->
        <!-- MESSAGES -->
        <!-- ============================================= -->

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

                                    <li>
                                        {{ $error }}
                                    </li>

                                @endforeach

                            </ul>

                        </div>

                    @endif

                </div>

            </div>

        </div>


        <!-- ============================================= -->
        <!-- ADD STOCK TRANSACTION FORM -->
        <!-- ============================================= -->

        <div class="page-body">

            <div class="row">

                <div class="col-sm-12">

                    <div class="card">

                        <div class="card-block">

                            <h4 class="sub-title">
                                Add Stock Transaction
                            </h4>


                            <form
                                action="{{ url('add_stock') }}"
                                method="POST"
                            >

                                @csrf


                                <!-- PRODUCT -->

                                <div class="form-group row">

                                    <label class="col-sm-2 col-form-label">

                                        Product

                                    </label>


                                    <div class="col-sm-10">

                                        <select
                                            name="product_id"
                                            class="form-control"
                                            required
                                        >

                                            <option value="">
                                                Select Product
                                            </option>


                                            @foreach($product_data as $product)

                                                <option
                                                    value="{{ $product->id }}"
                                                    {{ old('product_id') == $product->id ? 'selected' : '' }}
                                                >

                                                    {{ $product->product_name }}

                                                    @if($product->sku)
                                                        - {{ $product->sku }}
                                                    @endif

                                                </option>

                                            @endforeach

                                        </select>

                                    </div>

                                </div>


                                <!-- TRANSACTION TYPE -->

                                <div class="form-group row">

                                    <label class="col-sm-2 col-form-label">

                                        Transaction Type

                                    </label>


                                    <div class="col-sm-10">

                                        <select
                                            name="transaction_type"
                                            class="form-control"
                                            required
                                        >

                                            <option value="">
                                                Select Transaction Type
                                            </option>

                                            <option
                                                value="increase"
                                                {{ old('transaction_type') == 'increase' ? 'selected' : '' }}
                                            >
                                                Increase
                                            </option>

                                            <option
                                                value="decrease"
                                                {{ old('transaction_type') == 'decrease' ? 'selected' : '' }}
                                            >
                                                Decrease
                                            </option>

                                        </select>

                                    </div>

                                </div>


                                <!-- QUANTITY -->

                                <div class="form-group row">

                                    <label class="col-sm-2 col-form-label">
                                        Quantity
                                    </label>


                                    <div class="col-sm-10">

                                        <input
                                            type="number"
                                            name="quantity"
                                            value="{{ old('quantity') }}"
                                            class="form-control"
                                            placeholder="Enter Quantity"
                                            min="1"
                                            required
                                        >

                                    </div>

                                </div>


                                <!-- REASON -->

                                <div class="form-group row">

                                    <label class="col-sm-2 col-form-label">

                                        Reason

                                    </label>


                                    <div class="col-sm-10">

                                        <textarea
                                            name="reason"
                                            class="form-control"
                                            placeholder="Enter reason"
                                            rows="4"
                                            required
                                        >{{ old('reason') }}</textarea>

                                    </div>

                                </div>


                                <!-- STATUS -->

                                <div class="form-group row">

                                    <label class="col-sm-2 col-form-label">

                                        Status

                                    </label>


                                    <div class="col-sm-10">

                                        <select
                                            name="status"
                                            class="form-control"
                                            required
                                        >

                                            <option value="">
                                                Select Status
                                            </option>

                                            <option
                                                value="1"
                                                {{ old('status') == '1' ? 'selected' : '' }}
                                            >
                                                Active
                                            </option>

                                            <option
                                                value="0"
                                                {{ old('status') == '0' ? 'selected' : '' }}
                                            >
                                                Deactive
                                            </option>

                                        </select>

                                    </div>

                                </div>


                                <!-- SUBMIT -->

                                <div class="form-group row">

                                    <div class="col-sm-10 offset-sm-2">

                                        <button
                                            type="submit"
                                            class="btn btn-primary"
                                        >

                                            <i class="fa fa-save"></i>

                                            Submit

                                        </button>

                                    </div>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        <!-- ============================================= -->
        <!-- STOCK LIST -->
        <!-- ============================================= -->

        <div class="page-body">

            <div class="row">

                <div class="col-sm-12">

                    <div class="category-card">


                        <!-- HEADER -->

                        <div class="category-card-header">

                            <div>

                                <h4>
                                    Stock List
                                </h4>

                                <p>
                                    Manage all stock transactions
                                </p>

                            </div>

                        </div>


                        <!-- TABLE -->

                        <div class="category-table-wrapper">

                            <table class="category-table">

                                <thead>

                                    <tr>

                                        <!-- <th>
                                            #
                                        </th> -->

                                        <th>
                                            ID
                                        </th>

                                        <th>
                                            Product
                                        </th>

                                        <th>
                                            Transaction Type
                                        </th>

                                        <th>
                                            Quantity
                                        </th>

                                        <th>
                                            Reason
                                        </th>

                                        <th>
                                            Status
                                        </th>

                                        <th>
                                            Created At
                                        </th>

                                       

                                    </tr>

                                </thead>


                                <tbody>

                                    @forelse($stock_data as $key => $stock)

                                        <tr>


                                            <!-- SERIAL NUMBER -->

                                            <!-- <td>

                                                {{ $key + 1 }}

                                            </td> -->


                                            <!-- ID -->

                                            <td>

                                                {{ $stock->id }}

                                            </td>


                                            <!-- PRODUCT -->

                                            <td>

                               {{ $stock->product->product_name ?? 'N/A' }}
                                            </td>


                                            <!-- TRANSACTION TYPE -->

                                            <td>

                                                @if($stock->transaction_type == 'increase')
                                                    <span class="status-badge status-active">
                                                        <i class="fa fa-plus-circle"></i>
                                                        Increase
                                                    </span>
                                                @else
                                                    <span class="status-badge status-inactive">
                                                        <i class="fa fa-minus-circle"></i>
                                                        Decrease
                                                    </span>
                                                @endif

                                            </td>


                                            <!-- QUANTITY -->

                                            <td>

                                                {{ $stock->quantity }}

                                            </td>


                                            <!-- REASON -->

                                            <td>

                                                {{ $stock->reason ?? 'N/A' }}

                                            </td>


                                            <!-- STATUS -->

                                            <td> 
                                                @if($stock->status == 'active')

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


                                            <!-- CREATED -->

                                            <td>

                                                {{ $stock->created_at }}

                                            </td>


                                          

                                        </tr>


                                    @empty

                                        <tr>

                                            <td
                                                colspan="9"
                                                class="empty-category"
                                            >

                                                <i class="fa fa-folder-open"></i>

                                                <strong>
                                                    No Stock Transactions Found
                                                </strong>

                                                <span>
                                                    Add your first stock transaction to get started.
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

@endsection
