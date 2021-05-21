@extends('Layout')
@section('title')
    - بيانات المكتب
@endsection
@section('PageHeader')
   بيانات المكتب
@endsection

@section('content')
        <office-info :office-info="{{json_encode($OfficeInfo)}}"></office-info>
@endsection

