@extends('Layout')

@section('title')
    @if(auth()->user()->role == 'سكرتير')
        - تعديل بيانات المعاملة
        @elseif(auth()->user()->role == 'مراجع فنى')
        - صفحة المعاملة
    @endif

@endsection
@section('PageHeader')
    صفحة المعاملة
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('plugins/select2/select2.min.css')}}">
@endsection
@section('content')


    <div id="app" style="padding-top:20px">


        @if(auth()->user()->role == 'سكرتير')
            <secretary-edit-transaction-section  :Transaction="{{$Transaction}}"></secretary-edit-transaction-section>
             @elseif(auth()->user()->role == 'مراجع فني')
            <reviser-edit-transaction  :Transaction="{{$Transaction}}"></reviser-edit-transaction>
             @elseif(auth()->user()->role == 'مدقق')
            <auditor-edit-transaction  :Transaction="{{$Transaction}}"></auditor-edit-transaction>
             @elseif(auth()->user()->role == 'مدير مراجعة')
            <revising-manager-edit-transaction :Transaction="{{$Transaction}}"></revising-manager-edit-transaction>
            @elseif(auth()->user()->role == 'شريك اداري')
            <partner-edit-transaction :Transaction="{{$Transaction}}"></partner-edit-transaction>
        @endif
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/app.js')}}"></script>
    <script src="{{asset('plugins/select2/select2.full.min.js')}}"></script>
    <script>
        $(function () {
            //Initialize Select2 Elements
            $(".select2").select2();
        });
    </script>
@endsection
