<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from technext.github.io/guruable/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 09 Sep 2025 08:43:39 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
    <title>Smart Inventory Management</title>
    <!-- HTML5 Shim and Respond.js IE9 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
      <!-- Meta -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="description" content="CodedThemes">
      <meta name="keywords" content=" Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
      <meta name="author" content="CodedThemes">
      <!-- Favicon icon -->
      <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
      <!-- Google font-->   
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
      <!-- Required Fremwork -->
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap/css/bootstrap.min.css') }}">
      <!-- themify-icons line icon -->
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/icon/themify-icons/themify-icons.css') }}">
      <!-- ico font -->
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/icon/icofont/css/icofont.css') }}">
      <!-- Style.css -->
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.mCustomScrollbar.css') }}">
      <link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css') }}">
  </head>
  <style>
    /* ================================
       COMMON TOGGLE / SLIDE ANIMATION
    ================================= */

    .toggle-panel {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.4s ease;
    }

    .toggle-panel.open {
        max-height: 2000px;
    }

    .toggle-panel-inner {
        padding: 20px;
    }
    .toggle-form-inner {
    padding: 30px;
}

    .btn-close-form {
        background: none;
        border: none;
        font-size: 24px;
        line-height: 1;
        cursor: pointer;
    }
</style>
  @include('common_table_css')
  <body>
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">

                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
            </div>
        </div>
    </div>



       <!-- Pre-loader end -->
       <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            <nav class="navbar header-navbar pcoded-header">
                <div class="navbar-wrapper">

                    <div class="navbar-logo">
                        <a class="mobile-menu" id="mobile-collapse" href="#!">
                            <i class="ti-menu"></i>
                        </a>
                        <a class="mobile-search morphsearch-search" href="#">
                            <i class="ti-search"></i>
                        </a>
                        <a href="{{ url('/') }}" style="font-size:18px; font-weight: bold; color: white; text-decoration: none;font-family: Arial, sans-serif;">
                            <!-- <img class="img-fluid" src="assets/images/logo.png" alt="Theme-Logo" /> -->
                             Inventory System
                        </a>
                        <a class="mobile-options">
                            <i class="ti-more"></i>
                        </a>
                    </div>

                    <div class="navbar-container container-fluid">
                        <ul class="nav-left">
                            <li>
                                <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a></div>
                            </li>

                            <li>
                                <a href="#!" onclick="javascript:toggleFullScreen()">
                                    <i class="ti-fullscreen"></i>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav-right">
                            <!-- <li class="header-notification">
                                <a href="#!">
                                    <i class="ti-bell"></i>
                                    <span class="badge bg-c-pink"></span>
                                </a>
                                <ul class="show-notification">
                                    <li>
                                        <h6>Notifications</h6>
                                        <label class="label label-danger">New</label>
                                    </li>
                                    <li>
                                        <div class="media">
                                            <img class="d-flex align-self-center img-radius" src="assets/images/avatar-4.jpg" alt="Generic placeholder image">
                                            <div class="media-body">
                                                <h5 class="notification-user">John Doe</h5>
                                                <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                                <span class="notification-time">30 minutes ago</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="media">
                                            <img class="d-flex align-self-center img-radius" src="{{ asset('assets/images/avatar-3.jpg') }}" alt="Generic placeholder image">
                                            <div class="media-body">
                                                <h5 class="notification-user">Joseph William</h5>
                                                <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                                <span class="notification-time">30 minutes ago</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="media">
                                            <img class="d-flex align-self-center img-radius" src="{{ asset('assets/images/avatar-4.jpg') }}" alt="Generic placeholder image">
                                            <div class="media-body">
                                                <h5 class="notification-user">Sara Soudein</h5>
                                                <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                                <span class="notification-time">30 minutes ago</span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li> -->
                            <li class="user-profile header-notification">
                                <a href="#!">
                                <img class="img-40 img-radius" src="{{ asset('assests_uploads\profileavtar(1).jpg') }}" alt="User-Profile-Image">
                                <span>
                                         @if(session('id'))
                                           {{ session('admin_name') }}
                                           @else
                                           'Unknown'
                                         @endif
                                    </span>
                                    <i class="ti-angle-down"></i>
                                </a>
                                <ul class="show-notification profile-notification">
                                    <!-- <li>
                                        <a href="#!">
                                            <i class="ti-settings"></i> Settings
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="ti-user"></i> Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="ti-email"></i> My Messages
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="ti-lock"></i> Lock Screen
                                        </a>
                                    </li> -->
                                    <li>
                                        <a href="{{ url('logout') }}">
                                            <i class="ti-layout-sidebar-left"></i> Logout
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <nav class="pcoded-navbar">
                        <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
                        <div class="pcoded-inner-navbar main-menu">
                            <div class="">
                                <div class="main-menu-header">
                                    <img class="img-40 img-radius" src="{{ asset('assests_uploads\profileavtar(1).jpg') }}" alt="User-Profile-Image">
                                    <div class="user-details">
                                        <span>

                                            @if(session('id'))
                                           {{ session('admin_name') }}
                                           @else
                                           'Unknown'
                                         @endif
                                        </span>
                                        <span id="more-details">Admin Panel<i class="ti-angle-down"></i></span>
                                    </div>
                                </div>

                                <div class="main-menu-content">
                                    <ul>
                                        <li class="more-details">
                                            <a href="#"><i class="ti-user"></i>View Profile</a>
                                            <a href="#!"><i class="ti-settings"></i>Settings</a>
                                            <a href="auth-normal-sign-in.html"><i class="ti-layout-sidebar-left"></i>Logout</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- <div class="pcoded-search">
                                <span class="searchbar-toggle">  </span>
                                <div class="pcoded-search-box ">
                                    <input type="text" placeholder="Search">
                                    <span class="search-icon"><i class="ti-search" aria-hidden="true"></i></span>
                                </div>
                            </div> -->
                            <!-- <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation">Layout</div> -->
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="active">
                                    <a href="{{ url('/') }}">
                                        <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Dashboard</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li class="pcoded-hasmenu {{Request::is('categorydata') ? 'active' :'' }}"">
                                    <a href="{{ url('categorydata') }}">
                                        <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                                        <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">Category</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>


                                <li class="pcoded-hasmenu {{Request::is('sub_categorydata') ? 'active' :'' }}">
                                    <a href="{{ url('sub_categorydata/') }}">
                                        <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                                        <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">Sub Category</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                

                                <li class="pcoded-hasmenu  {{Request::is('branddata') ? 'active' :'' }}">
                                    <a href="{{ url('branddata/') }}">
                                        <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                                        <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">Brand</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>

                                <li class="pcoded-hasmenu {{Request::is('supplierList') ? 'active' :'' }}">
                                    <a href="{{ url('supplierList/') }}">
                                        <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                                        <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">Supplier</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>

                                <li class="pcoded-hasmenu {{Request::is('get_products') ? 'active' :'' }}">
                                    <a href="{{ url('get_products') }}">
                                        <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                                        <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">Product</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                

                                <li class="pcoded-hasmenu {{Request::is('get_purchases/0') ? 'active' :'' }}">
                                    <a href="{{ url('get_purchases/0') }}">
                                        <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                                        <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">Purchase</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>


                                <li class="pcoded-hasmenu {{Request::is('stock_list') ? 'active' :'' }}">
                                    <a href="{{ url('stock_list/') }}">
                                        <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                                        <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">Manage Stock</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>



                                
                                <li class="pcoded-hasmenu {{Request::is('get_sales') ? 'active' :'' }}">
                                    <a href="{{ url('get_sales/') }}">
                                        <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                                        <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">Manage Sales(POS)</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li class="pcoded-hasmenu {{Request::is('get_customer') ? 'active' :'' }}">
                                    <a href="{{ url('get_customer/') }}">
                                        <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                                        <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">Manage Customers</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>


                                <li class="pcoded-hasmenu {{Request::is('sale_refunds') ? 'active' :'' }}">
                                    <a href="{{ url('sale_refunds/') }}">
                                        <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                                        <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">Manage Sale Refunds</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>



                            </ul>
                    </nav>
    <!-- #region -->

     <div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">

       @yield('content')
                              </div>
                      </div>
                 </div>
             </div>



                    <!-- Warning Section Ends -->
<!-- Required Jquery -->
<script type="text/javascript" src="{{ asset('assets/js/jquery/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/jquery-ui/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/js/popper.js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/js/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript" src="{{ asset('/assets/js/jquery-slimscroll/jquery.slimscroll.js') }}"></script>
<!-- modernizr js -->
<script type="text/javascript" src="{{ asset('/assets/js/modernizr/modernizr.js') }}"></script>
<!-- am chart -->
<script src="{{ asset('/assets/pages/widget/amchart/amcharts.min.js') }}"></script>
<script src="{{ asset('/assets/pages/widget/amchart/serial.min.js') }}"></script>
<!-- Todo js -->
<script type="text/javascript " src="{{ asset('assets/pages/todo/todo.js') }}"></script>
<!-- Custom js -->
<script type="text/javascript" src="{{ asset('/assets/pages/dashboard/custom-dashboard.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/js/script.js') }}"></script>
<script type="text/javascript " src="{{ asset('/assets/js/SmoothScroll.js') }}"></script>
<script src="{{ asset('/assets/js/pcoded.min.js') }}"></script>
<script src="{{ asset('/assets/js/demo-12.js') }}"></script>
<script src="{{ asset('/assets/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script>
var $window = $(window);
var nav = $('.fixed-button');
    $window.scroll(function(){
        if ($window.scrollTop() >= 200) {
         nav.addClass('active');
     }
     else {
         nav.removeClass('active');
     }
 });
</script>

<script>
    // =========================================
    // COMMON TOGGLE / SLIDE FUNCTIONS
    // =========================================

    function slideOpen(el)
    {
        if (!el) {
            return;
        }

        el.classList.add('open');

        el.style.maxHeight = el.scrollHeight + 'px';
    }


    function slideClose(el)
    {
        if (!el) {
            return;
        }

        el.style.maxHeight = '0px';

        el.classList.remove('open');
    }


    function togglePanel(id)
    {
        const panel = document.getElementById(id);

        if (!panel) {
            return;
        }

        if (panel.classList.contains('open')) {

            slideClose(panel);

        } else {

            slideOpen(panel);
        }
    }


    // =========================================
    // SET OPEN PANEL HEIGHT ON PAGE LOAD
    // =========================================

    document.addEventListener('DOMContentLoaded', function()
    {
        const openPanels = document.querySelectorAll('.toggle-panel.open');

        openPanels.forEach(function(panel)
        {
            panel.style.maxHeight = panel.scrollHeight + 'px';
        });
    });
</script>

<!-- ck editor -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))

<script>
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: "{{ session('success') }}",
        confirmButtonText: 'OK'
    });
</script>

@endif



@if(session('error'))

<script>
    Swal.fire({
        icon: 'error',
        title: 'Error!',
        text: "{{ session('error') }}",
        confirmButtonText: 'OK'
    });
</script>

@endif
</body>


<!-- Mirrored from technext.github.io/guruable/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 09 Sep 2025 08:43:55 GMT -->
</html>
