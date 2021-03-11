@extends('Layout')

@section('title')
    - معاملة جديدة
@endsection

@section('PageHeader')
    إضافة معاملة جديدة
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('plugins/select2/select2.min.css')}}">
@endsection
@section('content')


    <div id="app"  style="padding-top: 50px">
        <div class="row">

            <div class="col-md-12">
                <new-transaction></new-transaction>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

    <script src="{{ asset('js/app.js')}}"></script>
    <script src="{{asset('plugins/select2/select2.full.min.js')}}"></script>
    <script>
        $(function () {
            //Initialize Select2 Elements
            $(".select2").select2();
        });
    </script>
@endsection
