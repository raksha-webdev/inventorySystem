@extends('admin_master')
<style>
.card1-icon {
    width: 55px;
    height: 55px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    border-radius: 12px;
    margin-left: auto;
}

/* Total Sales */
.icon-sales {
    background-color: #DBEAFE;
    color: #2563EB;
}

/* Total Revenue */
.icon-revenue {
    background-color:#4A7420;
    color: #059669;
}

/* Total Purchases */
.icon-purchase {
    background-color: #01A751;
    color: #7C3AED;
}

/* Purchase Count */
.icon-purchase-count {
    background-color:#540050;
    color: #EA580C;
}

/* Total Users */
.icon-users {
    background-color: #EA580C;
    color: #0891B2;
}

/* Total Products */
.icon-products {
    background-color: #0891B2;
    color: #4F46E5;
}

/* Low Stock Products */
.icon-low-stock {
    background-color: red;
    color: #DC2626;
}

/* Total Categories */
.icon-category {
    background-color: #85225b;
    color: #DB2777;
}

/* Total Suppliers */
.icon-supplier {
    background-color: #059669;
    color: #0F766E;
}
</style>
@section('content')
                                    <div class="page-body">
                                        <div class="row">

                                        <div class="col-md-6 col-xl-3">
                                                <div class="card widget-card-1">
                                                    <div class="card-block-small">
                                                    <i class="fa-solid fa-chart-line bg-c-blue card1-icon"></i>
                                                        <span class="text-c-blue f-w-600">Total Sales</span>
                                                        <h4>{{ $sale }}</h4>
                                                        <div>
                                                            <span class="f-left m-t-10 text-muted">
                                                                <i class="text-c-blue f-16 icofont icofont-warning m-r-10"></i><a href="{{ url('get_sales/') }}" class="text-muted text-decoration-none">view Sales</a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                            </div>



                                            <div class="col-md-6 col-xl-3">
                                                <div class="card widget-card-1">
                                                    <div class="card-block-small">
                                                    <i class="fa-solid fa-sack-dollar card1-icon icon-revenue"></i>
                                                        <span class="text-c-blue f-w-600">Total Revenue</span>
                                                        <h4>{{ $sale_amt }}</h4>
                                                        <div>
                                                            <span class="f-left m-t-10 text-muted">
                                                                <i class="text-c-blue f-16 icofont icofont-warning m-r-10"></i><a href="{{ url('get_sales') }}" class="text-muted text-decoration-none">view Revenue</a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-xl-3">
                                                <div class="card widget-card-1">
                                                    <div class="card-block-small">
                                                    <i class="fa-solid fa-cart-shopping card1-icon icon-purchase"></i>
                                                        <span class="text-c-blue f-w-600">Total Purchases</span>
                                                        <h4>{{ $purchase_amt }}</h4>
                                                      
                                                        <div>
                                                            <span class="f-left m-t-10 text-muted">
                                                                <i class="text-c-blue f-16 icofont icofont-warning m-r-10"></i><a href="{{ url('get_purchases/0') }}" class="text-muted text-decoration-none">view Purchases</a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                            </div>

                                            
                                            <div class="col-md-6 col-xl-3">
                                                <div class="card widget-card-1">
                                                    <div class="card-block-small">
                                                    <i class="fa-solid fa-receipt card1-icon icon-purchase-count"></i>
                                                        <span class="text-c-blue f-w-600">Purchase count</span>
                                                        <h4>{{ $purchase }}</h4>
                                                        <div>
                                                            <span class="f-left m-t-10 text-muted">
                                                                <i class="text-c-blue f-16 icofont icofont-warning m-r-10"></i><a href="{{ url('get_purchases/0') }}" class="text-muted text-decoration-none">view Purchase</a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                            </div>




                                            
                                            <div class="col-md-6 col-xl-3">
                                                <div class="card widget-card-1">
                                                    <div class="card-block-small">
                                                        <i class="icofont icofont-pie-chart bg-c-blue card1-icon"></i>
                                                        <i class="fa-solid fa-triangle-exclamation card1-icon icon-low-stock"></i>
                                                        <span class="text-c-blue f-w-600">Low Stock Product</span>
                                                        <h4>{{ $low_stock }}</h4>
                                                      
                                                        <div>
                                                            <span class="f-left m-t-10 text-muted">
                                                                <i class="text-c-blue f-16 icofont icofont-warning m-r-10"></i><a href="{{ url('/get_products') }}" class="text-muted text-decoration-none">View Low Product</a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                            </div>


                                            <!-- card1 start -->
                                            <div class="col-md-6 col-xl-3">
                                                <div class="card widget-card-1">
                                                    <div class="card-block-small">
                                                    <i class="fa-solid fa-layer-group card1-icon icon-category"></i>    
                                                        <span class="text-c-blue f-w-600">Category</span>
                                                        <h4>{{ $catgory_count }}</h4>
                                                        <div>
                                                            <span class="f-left m-t-10 text-muted">
                                                                <i class="text-c-blue f-16 icofont icofont-warning m-r-10"></i><a href="{{ url('categorydata') }}" class="text-muted text-decoration-none">View Category</a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- card1 end -->
                                            <!-- card1 start -->
                                            <div class="col-md-6 col-xl-3">
                                                <div class="card widget-card-1">
                                                    <div class="card-block-small">
                                                    <i class="fa-solid fa-truck-field card1-icon icon-supplier"></i>
                                                        <span class="text-c-pink f-w-600">Total Supplier</span>
                                                        <h4>{{ $supplier }}</h4>
                                                        <div>
                                                            <span class="f-left m-t-10 text-muted">
                                                                <i class="text-c-pink f-16 icofont icofont-calendar m-r-10"></i><a href="{{ url('supplierList') }}" class="text-muted text-decoration-none">View Supplier  </a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- card1 end -->
                                            <!-- card1 start -->
                                            <div class="col-md-6 col-xl-3">
                                                <div class="card widget-card-1">
                                                    <div class="card-block-small">
                                                    <i class="fa-solid fa-boxes-stacked card1-icon icon-products"></i>
                                                    <span class="text-c-green f-w-600">Total Product</span>
                                                        <h4>{{ $product }}</h4>
                                                        <div>
                                                            <span class="f-left m-t-10 text-muted">
                                                                <i class="text-c-green f-16 icofont icofont-tag m-r-10"></i> 
                                                                <a href="{{ url('get_products') }}">View Product</a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- card1 end -->
                                            <!-- card1 start -->
                                             
                                            <div class="col-md-6 col-xl-3">
                                                <div class="card widget-card-1">
                                                    <div class="card-block-small">
                                                    <i class="fa-solid fa-users card1-icon icon-users"></i>
                                                        <span class="text-c-yellow f-w-600">Total User</span>
                                                        <h4>{{ $user }}</h4>
                                                        <div>
                                                            <span class="f-left m-t-10 text-muted">
                                                                <i class="text-c-yellow f-16 icofont icofont-refresh m-r-10"></i>
                                                                <a href="#">View All User</a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- card1 end -->
                                            
                                            </div>
                                    </div>
                                    

                               
        <!-- Warning Section Starts -->
        <!-- Older IE warning message -->
    <!--[if lt IE 9]>
<div class="ie-warning">
    <h1>Warning!!</h1>
    <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
    <div class="iew-container">
        <ul class="iew-download">
            <li>
                <a href="http://www.google.com/chrome/">
                    <img src="assets/images/browser/chrome.png" alt="Chrome">
                    <div>Chrome</div>
                </a>
            </li>
            <li>
                <a href="https://www.mozilla.org/en-US/firefox/new/">
                    <img src="assets/images/browser/firefox.png" alt="Firefox">
                    <div>Firefox</div>
                </a>
            </li>
            <li>
                <a href="http://www.opera.com">
                    <img src="assets/images/browser/opera.png" alt="Opera">
                    <div>Opera</div>
                </a>
            </li>
            <li>
                <a href="https://www.apple.com/safari/">
                    <img src="assets/images/browser/safari.png" alt="Safari">
                    <div>Safari</div>
                </a>
            </li>
            <li>
                <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                    <img src="assets/images/browser/ie.png" alt="">
                    <div>IE (9 & above)</div>
                </a>
            </li>
        </ul>
    </div>
    <p>Sorry for the inconvenience!</p>
</div>
<![endif]-->

@endsection