@extends('Layout')
@section('title')
    - بيانات المكتب
@endsection
@section('PageHeader')
   بيانات المكتب
@endsection

@section('content')
    <div id="app"  style="padding-top: 50px">
        <div class="row">
            <div class="col-md-12">
                <office-info :office-info="{{json_encode($OfficeInfo)}}"></office-info>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

    <script src="{{ asset('js/app.js')}}"></script>

@endsection
