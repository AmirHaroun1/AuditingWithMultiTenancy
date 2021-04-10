<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>
        مكتب المحاسبة
        @yield('title')
    </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    @routes
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">

    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('dist/css/skins/_all-skins.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('plugins/iCheck/flat/blue.css')}}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{asset('plugins/morris/morris.css')}}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{asset('plugins/jvectormap/jquery-jvectormap-1.2.2.css')}}">

    <!-- Daterange picker -->

    <link rel="stylesheet" href="{{asset('dist/fonts/fonts-fa.css')}}">
    <link rel="stylesheet" href="{{asset('dist/css/bootstrap-rtl.min.css')}}">
    <link rel="stylesheet" href="{{asset('dist/css/rtl.css')}}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.9.55/css/materialdesignicons.min.css" integrity="sha512-vIgFb4o1CL8iMGoIF7cYiEVFrel13k/BkTGvs0hGfVnlbV6XjAA0M0oEHdWqGdAVRTDID3vIZPOHmKdrMAUChA==" crossorigin="anonymous" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->
    @yield('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body style="background:#eee;">

@section('body')
<div id="app">
<v-app>
<aside class=" main-sidebar">
        <!-- right side column. contains the logo and sidebar -->

        @include('layout._Sidebar')

    </aside>
        <!-- <v-toolbar
        height="30px"
        dense
        color="primary"
        ></v-toolbar> -->
    <div class="content-wrapper v-content__wrap">
        <!-- Content Wrapper. Contains the content of the page -->
        <!-- Content Header (Page header) -->
        <!-- <section class="content-header">

            <h1 class="margin-50">
                @section('PageHeader')
                    الرئيسية
                    @auth
                        <small>{{auth()->user()->role}}</small>
                    @endauth
                @show
            </h1>

        </section> -->

        <!-- Main content -->
        <section class="content margin-50">
            <!--------------------------- Flash Messages -------------------->
            @if(\Illuminate\Support\Facades\Session::has('success'))
                <div class="callout callout-success">
                    <h4>{{\Illuminate\Support\Facades\Session::get('success')}}</h4>
                </div>

            @elseif(\Illuminate\Support\Facades\Session::has('failed'))
                <div class="callout callout-danger">
                    <h4>{{\Illuminate\Support\Facades\Session::get('failed')}}</h4>
                </div>
            @endif
        <!--------------------------- /Flash Messages -------------------->

            @section('content')

            @show
        </section><!-- /.content -->
     
        <!-- /.Main-side -->
    </div>
    <!-- ./content-wrapper -->



    </v-app>
    </div>



    <!-- jQuery 2.1.4 -->
    <script src="{{asset('plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.4 -->
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>

    @yield('scripts')

@show
<!-- Sparkline -->
<script src="{{asset('plugins/sparkline/jquery.sparkline.min.js')}}"></script>

<script src="{{asset('plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('plugins/fastclick/fastclick.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/app.min.js')}}"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>

</body>
</html>
