<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <title>@yield('seo_title','Best webshop in the world!') | Admin Area</title>
        
        <meta name="description" content="@yield('seo_description', __('Buy best cloathing, shoes and...'))">

        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="{{url('themes/admin/plugins/fontawesome-free/css/all.min.css')}}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{url('themes/admin/dist/css/adminlte.min.css')}}">
        <!-- SweetAlert2 -->
        <link rel="stylesheet" href="{{url('/themes/admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
        <!-- Toastr -->
        <link rel="stylesheet" href="{{url('/themes/admin/plugins/toastr/toastr.min.css')}}">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        <!--iCheck for checkboxes and radio inputs-->
        <link href="{{url('/themes/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
        <!--Select 2 -->
        <link href="{{url('/themes/admin/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{url('/themes/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}" rel="stylesheet" type="text/css"/>
        <!-- DataTables -->
        <link rel="stylesheet" href="{{url('/themes/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
        @stack('head_links')
    </head>
    <body class="hold-transition sidebar-mini">
        <div class="wrapper">

            <!-- Navbar -->
            @include('admin._layout.partials.navbar')
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            @include('admin._layout.partials.sidebar')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                @yield('content')
            </div>
            <!-- /.content-wrapper -->



            <!-- Main Footer -->
            @include('admin._layout.partials.footer')
        </div>
        <!-- ./wrapper -->

        <!-- REQUIRED SCRIPTS -->

        <!-- jQuery -->
        <script src="{{url('/themes/admin/plugins/jquery/jquery.min.js')}}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{url('/themes/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <!-- Toastr -->
        <script src="{{url('/themes/admin/plugins/toastr/toastr.min.js')}}"></script>
        <!-- Select2 -->
        <script src="{{url('/themes/admin/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
        <!-- Validation Plugin -->
        <script src="{{url('/themes/admin/plugins/jquery-validation/jquery.validate.min.js')}}" type="text/javascript"></script>
        <script src="{{url('/themes/admin/plugins/jquery-validation/additional-methods.min.js')}}" type="text/javascript"></script>
        <!-- DataTables -->
        <script src="{{url('/themes/admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{url('/themes/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>

        <script type="text/javascript">

//Citanje i prikaz sistemskih  poruka iz sesije pomocu Toastr-a;
        let systemMessage = "{{session()->pull('system_message')}}";
        if (systemMessage !== "") {
            toastr.success(systemMessage);
        }

        let systemError = "{{session()->pull('system_error')}}";
        if (systemError !== "") {
            toastr.error(systemError);
        }



        </script>
        <!-- AdminLTE App -->
        <script src="{{url('/themes/admin/dist/js/adminlte.min.js')}}"></script>
        @stack('footer_javascript')
    </body>
</html>
