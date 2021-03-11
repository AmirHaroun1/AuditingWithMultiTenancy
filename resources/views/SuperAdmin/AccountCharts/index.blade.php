@extends('Layout')
@section('title')
    - الدليل المحاسبى
@endsection
@section('PageHeader')
    اعدادات الدليل المحاسبى
@endsection
@section('css')

@endsection
@section('content')
    <div id="app"  style="padding-top: 50px">
        <div class="row">
            <div class="col-md-12">
                <account-charts-management></account-charts-management>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

    <script src="{{ asset('js/app.js')}}"></script>


@endsection
