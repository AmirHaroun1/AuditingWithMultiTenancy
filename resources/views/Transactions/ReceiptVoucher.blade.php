<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>سند قبض</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.4 -->
    <link rel="stylesheet"  href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet"  href="{{asset('dist/css/AdminLTE.min.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body onload="window.print();">
<div class="wrapper">
    <!-- Main content -->
    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header pull-right" >
                    <i class="fa fa-globe"></i>
                    {{$ReviserCompanyName}}
                </h2>
            </div><!-- /.col -->
            <hr>

        </div>
        <!-- info row -->
        <div class="row invoice-info" style="border: 2px black solid;padding-top:30px;padding-bottom:30px">
            <div class="col-md-12">
                <h2  class="text-center">سند قبض </h2>
                <h3 style="padding-top: 20px;float: right;direction: rtl;">
                    استلمنا نحن مكتب
                    {{$ReviserCompanyName}}
                    للمراجعة من شركة
                    {{$InistitutionName}}
                    مبلغ
                <strong style="margin-right: 7px;margin-left: 7px">
                    {{$PaymentValue}}

                </strong>
                    وذلك قيمة
                    {{$PaymentType}}
                    نظير  مراجعة القوائم المالية للعام
                    {{$TransactionYear}}
                    م

                </h3>
            </div>
            <div class="col-xs-4">
                <h4 style="padding-top: 40px;float: right">
                    /
                    المدير الاداري

                </h4>
            </div>
            <div class="col-xs-4">
                <h4 style="padding-top: 40px;float: right">
                    /
                    المحاسب

                </h4>
            </div>
            <div class="col-xs-4">
                <h4 style="padding-top: 40px;float: right">
                    /
                    تاريخ

                </h4>
            </div>
        </div><!-- /.row -->

    </section><!-- /.content -->
</div><!-- ./wrapper -->

<!-- AdminLTE App -->
<script src="{{asset('dist/js/app.min.js')}}"></script>
</body>
</html>
