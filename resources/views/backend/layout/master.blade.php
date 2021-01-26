<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
    @if (request()->path() == 'home')
        <title>Welcome to {{ config('app.name', 'Laravel') }}</title>
    @endif
    @yield('title')
    <link rel="icon" href="{{ asset('icons/logo.png') }}">
    <link href="{{ asset('plugins/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('plugins/css/metismenu.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('plugins/css/icons.css') }}" rel="stylesheet" type="text/css">
    <!-- Toastr -->
    @toastr_css
    @stack('css')
    <link href="{{ asset('plugins/css/style.css') }}" rel="stylesheet" type="text/css">
</head>

<body>
    <!-- Begin page -->
    <div id="wrapper">
        <!-- Top Bar Start -->
        @include('backend.partial.navbar')
    <!-- Top Bar End -->
    <!-- ========== Left Sidebar Start ========== -->
        @include('backend.partial.sidebar')
    <!-- Left Sidebar End -->
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container-fluid">
                <div class="page-title-box">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <h4 class="page-title">@yield('page_index')</h4>
                            <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Welcome to {{ config('app.name', 'Laravel') }} - {{ Auth::user()->name }}</li>
                            <li class="text-bold text-success">{{ Auth::user()->type }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
                {{-- main content starts here --}}
                @yield('main_content')
                {{-- main content stops here --}}
            </div>
        <!-- container-fluid -->
    </div>
    <!-- content -->
    <footer class="footer">© 2019 BAIUST ICT WING <span class="d-none d-sm-inline-block">- Crafted by <i class="mdi mdi-account-star text-danger"></i> Chafiullah</span>.</footer>
    </div>
    <!-- ============================================================== -->
    <!-- End Right content here -->
    <!-- ============================================================== -->
    </div>
    <!-- END wrapper -->
    <!-- jQuery  -->
    <script src="{{ asset('plugins/js/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('plugins/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('plugins/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('plugins/js/waves.min.js') }}"></script>
    <!--Chartist Chart-->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/chartist/0.11.0/chartist.js"></script>
    <script src="{{ asset('plugins/js/chartist-plugin-tooltip.min.js') }}"></script> --}}
    <!-- peity JS -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/peity/3.3.0/jquery.peity.js"></script>
    <script src="{{ asset('plugins/pages/dashboard.js') }}"></script> --}}
    <!-- App js -->
    @toastr_js
    @toastr_render
    @stack('js')
    <script src="{{ asset('plugins/js/app.js') }}"></script>
</body>
</html>
