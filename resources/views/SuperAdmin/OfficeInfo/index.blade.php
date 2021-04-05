@extends('Layout')
@section('title')
    - بيانات المكتب
@endsection
@section('PageHeader')
   بيانات المكتب
@endsection

@section('content')
Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique quam ex eius vel illo nisi ea sed asperiores voluptatibus modi, corporis, voluptates consequatur. Similique alias pariatur, nesciunt illum laboriosam ad.
        <office-info :office-info="{{json_encode($OfficeInfo)}}"></office-info>
@endsection
@section('scripts')

    <script src="{{ asset('js/app.js')}}"></script>

@endsection
