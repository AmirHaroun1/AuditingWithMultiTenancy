@extends('Layout')

@section('title')
     - الرئيسية أدمن
@endsection
@section('content')
    <div id="app">
        <dash-board :office-Branch="{{$OfficeBranch}}" :Team="{{$Team}}"></dash-board>
    </div>
@endsection

