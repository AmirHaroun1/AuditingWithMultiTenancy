@extends('Layout')
@section('title')
    - التوقيع
@endsection
@section('PageHeader')
    التوقيع
@endsection
@section('content')
    <div id="app"  style="padding-top: 50px">
        <div class="row">
            <div class="col-md-12">
                <employee-signature :Auth-User="{{json_encode(auth()->user())}}"></employee-signature>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

    <script src="{{ asset('js/app.js')}}"></script>

@endsection
