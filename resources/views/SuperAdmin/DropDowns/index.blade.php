@extends('Layout')
@section('title')
    - القوائم المنسدلة
@endsection
@section('PageHeader')
   اعدادات البرنامج
@endsection

@section('content')
        <drop-downs-management></drop-downs-management>
@endsection
@section('scripts')

    <script src="{{ asset('js/app.js')}}"></script>


@endsection
