@extends('Layout')
@section('title')
    - القوائم المنسدلة
@endsection
@section('PageHeader')
   اعدادات البرنامج
@endsection

@section('content')
    <div id="app"  style="padding-top: 50px">
        <div class="row">
            <div class="col-md-12">
                <drop-downs-management></drop-downs-management>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

    <script src="{{ asset('js/app.js')}}"></script>


@endsection
