@extends('Layout')
@section('title')
    - فروع المكتب
@endsection
@section('PageHeader')
    - فروع المكتب
@endsection

@section('content')
    <office-branches></office-branches>
@endsection
@section('scripts')

    <script src="{{ asset('js/app.js')}}"></script>

@endsection
