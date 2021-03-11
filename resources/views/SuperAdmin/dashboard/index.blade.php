@extends('Layout')

@section('title')
     - الرئيسية أدمن
@endsection
@section('content')
    <div id="app">
        <dash-board :Transactions-Status="{{$TransactionsStatus}}" :Team="{{$Team}}"></dash-board>
    </div>
@endsection
@section('scripts')

    <script src="{{ asset('js/app.js')}}"></script>

@endsection
