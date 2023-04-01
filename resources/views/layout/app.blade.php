@php
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    header('Content-Type: text/html');

@endphp

<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <noscript>
        <META HTTP-EQUIV="Refresh" CONTENT="0;URL={{ route('js_disabled')}}">
            {{--  Sorry...JavaScript is needed to go ahead. --}}
    </noscript>
    <meta name="description" content="Real Estate">
    <meta name="keywords" content="Real Estate">
    <meta name="author" content="Real Estate">
    <title>Real Estate - @yield('title')</title>
    <link rel="apple-touch-icon" href="{{  asset('theme/app-assets/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('media/defaults/favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{  asset('theme/app-assets/vendors/css/vendors.min.css') }}">
    <!-- END: Vendor CSS-->

     <!-- Select2 -->
     <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/vendors/css/forms/select/select2.min.css')}}">
     <!-- Select2 -->

     <!-- Sweet Alert-->
     <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/vendors/css/animate/animate.css')}}">
     <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
     <!-- Sweet Alert Done-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{  asset('theme/app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{  asset('theme/app-assets/css/bootstrap-extended.css?v='.time())}}">
    <link rel="stylesheet" type="text/css" href="{{  asset('theme/app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{  asset('theme/app-assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{  asset('theme/app-assets/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{  asset('theme/app-assets/css/themes/bordered-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{  asset('theme/app-assets/css/themes/semi-dark-layout.css') }}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{  asset('theme/app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{  asset('theme/assets/css/style.css') }}">
    <!-- END: Custom CSS-->

    <!-- BEGIN: Plugin CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/vendors/css/extensions/toastr.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css/plugins/extensions/ext-component-toastr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css/pages/ui-feather.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
    <!-- END: Plugin CSS-->

    @yield('css')

     <!-- Custom CSS-->
    <style>
        .toast-progress {right: 0; left: auto;}

        .dark-box{
            background: #161D31 !important;
        }
        .required:after {
            content:" *";
            color: red;
        }
        .readonly-input{
            background-color: #ffffff !important;
            border: none;
        }
        .dataTables_scrollBody::-webkit-scrollbar-track
        {
            -webkit-box-shadow: inset 0 0 2px rgba(0,0,0,0.3);
            border-radius: 10px;
            background-color: #F5F5F5;
        }

        .dataTables_scrollBody::-webkit-scrollbar
        {
            height: 12px;              /* height of horizontal scrollbar */
            width: 12px;               /* width of vertical scrollbar */
            background-color: #F5F5F5;
            scroll-behavior: smooth;
        }

        .dataTables_scrollBody::-webkit-scrollbar-thumb
        {
            border-radius: 10px;
            -webkit-box-shadow: inset 0 0 2px rgba(0,0,0,.3);
            background-color: #DAE1E7;
        }

        .dt-search{
            background: transparent;
            color: rgba(0, 0, 0, 0.87);
            font-family: inherit;
            font-size: inherit;
            height: 40px;
            padding-bottom: 8px;
            border-width: 0;
            border-bottom: 2px solid #e2e2e2;
        }

        .custom-bl{ /* break large string and eclipse */
            padding-top: 1mm;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .custom-dc{
            height: 12rem;
        }

        .custom-bl:hover{
            overflow: visible;
            white-space: normal;
            height:auto;  /* just added this line */
            z-index: 5;
        }

        .control-label{
            text-transform: capitalize;
        }

        .custom-date{
            background-color: transparent !important;
        }

        .custom-date:disabled {
            background-color: #efefef !important;
        }

        .custmStr {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .custmStr:hover {
            overflow: visible;
        }
    </style>

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern content-left-sidebar navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="content-left-sidebar">

    <!-- BEGIN: Header-->
    @include('layout.navbar')
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item me-auto">
                    <a class="navbar-brand" href="{{ route('main_dashboard') }}">
                        <img src="{{ asset('media/defaults/favicon.ico') }}" id="Logo" alt="" srcset="" class="img-responsive" style="height:40px;object-fit:scale-down;">
                        <h2 class="brand-text twtx">Real Estate</h2>
                    </a>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            @include('sidebar.main')
        </div>
    </div>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                @yield('breadcrumbs')
            </div>
            <div class="content-body">
                <!-- Page Content Start -->
                @yield('content')
                <!-- Page Content End -->
            </div>
        </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix mb-0"><span class="float-md-start d-block d-md-inline-block mt-25">&copy; 2023<a class="ms-25" href="https://1.envato.market/pixinvent_portfolio" target="_blank">Pixinvent</a><span class="d-none d-sm-inline-block">, All rights Reserved</span></span><span class="float-md-end d-none d-md-block">Hand-crafted & Made with<i data-feather="heart"></i></span></p>
    </footer>
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('theme/app-assets/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('theme/app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
    <script src="{{ asset('theme/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
    <script src="{{ asset('theme/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('theme/app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('theme/app-assets/js/core/app.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- All type message function in this JS file -->
    <script src="{{asset('custom_js/message.js?v='.time())}}"></script>
    <script>

    // Prevent Double Submits
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', (e) => {
            if (form.classList.contains('is-submitting')) {
                e.preventDefault();
            }
            form.classList.add('is-submitting');
        });
    });

    $(document).ajaxStart(function () {
        $('button[type="submit"]').prop('disabled', true);
    });
    $(document).ajaxComplete(function () {
        $('button[type="submit"]').prop('disabled', false);
    });

    var api_url = "{{config('app.url')}}/api";
    var isset = function(variable){
        return typeof(variable) !== "undefined" && variable !== null && variable !== '';
    }
    var empty = function(variable){
        return typeof(variable) == "undefined" || variable == null || variable == '' || isNaN(variable); //isNan For Numeric Value
    }

    $(".select2").select2({
        width: '100%',
    });

    $("input[type=number]").attr("min","0");

    /*--- Note : Set Focus On Form fields-------*/
    $(document).ready(function() {
        $('form:first *:input[type!=hidden]:first').focus(); // focus on first input
        $('body').on('keydown', 'input, select,textarea', function(e) { // enter to focus next
            var self = $(this)
                , form = self.parents('form:eq(0)')
                , focusable
                , next
                ;
            if (e.keyCode == 13) {
                focusable = form.find('input,a,select,button,textarea').filter(':visible');
                next = focusable.eq(focusable.index(this)+1);
                if (next.length) {
                    next.focus();
                } else {
                    form.submit();
                }
                return false;
            }
        });
        $(document).on('focus', '.select2', function (e) { // single property dropdown opens when focus
            if(!$(this).closest(".select2").siblings('select:enabled').prop('multiple')){
                $(this).closest(".select2").siblings('select:enabled').select2('open'); // use when select has single input
            }
        });
    });

    /*--- Note : Load feather icon-------*/
    $(window).on('load', function() {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    })

    /*--- Note : Light and Dark theme-------*/
    $('html').addClass(localStorage.getItem('light-layout-current-skin'));
    if(localStorage.getItem('light-layout-current-skin') == 'light-layout'){
        $('.nav-link-style .ficon').attr('data-feather','moon');
    }else{
        $('.nav-link-style .ficon').attr('data-feather','sun');
    }

    </script>
    @yield('js')
</body>
<!-- END: Body-->

</html>
