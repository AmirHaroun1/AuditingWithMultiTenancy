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
<body class="skin-black bg-gray sidebar-mini sidebar-collapse">

@section('body')
    <!-- header logo: style can be found in header.less -->
    <header class="main-header">
        <a href="#" class="logo">
            <!-- Add the class icon to your logo image or logo icon to add the margining -->
            مكتب المحاسبة
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top margin-50" role="navigation">
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <!-- Sidebar toggle button-->

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    @auth
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>

                                        {{auth()->user()->name}}
                                    <i class="caret"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="{{asset('images/unknownAvatar.jpg')}}" class="img-circle" alt="User Image" />

                                    <p>
                                            {{auth()->user()->name}}
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer ">

                                    <div class="text-center">

                                        <a href="{{route('logout')}}" class="btn btn-default btn-flat"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            تسجيل خروج
                                        </a>
                                    </div>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>

                    @endauth

                </ul>
            </div>

        </nav>
    </header>

    <aside class="main-sidebar">
        <!-- right side column. contains the logo and sidebar -->

        @include('layout._Sidebar')

    </aside>

    <div class="content-wrapper">


        <!-- Content Wrapper. Contains the content of the page -->
        <!-- Content Header (Page header) -->
        <section class="content-header">


            <h1 class="margin-50">
                @section('PageHeader')
                    الرئيسية
                    @auth
                        @if(auth()->user()->role == 'سوبر')
                            <small>أدمن</small>
                        @else
                            <small>{{auth()->user()->role}}</small>

                        @endif
                    @endauth
                @show
            </h1>

        </section>

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

    <footer class="main-footer">
        <div class="pull-left hidden-xs">
            <b>Version</b>1
        </div>
        <strong>Copyright © 2020 <a href="http://almsaeedstudio.com">Masooud El Rofidy</a>.</strong> All rights reserved.
    </footer>


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
