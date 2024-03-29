@extends('Layout')

@section('title')
    @if(auth()->user()->role == 'سكرتير')
        سكرتير - المعاملات

    @elseif(auth()->user()->role == 'مراجع فنى')
        مراجع فنى - المعاملات
    @elseif(auth()->user()->role == 'مدقق')
        مدقق - المعاملات
    @elseif(auth()->user()->role == 'مدير مراجعة')
        مدير مراجعة - المعاملات
    @elseif(auth()->user()->role == 'سكرتير تنفيذي')
        سكرتير تنفيذي - المعاملات
    @endif
@endsection

@section('PageHeader')

@endsection
@section('content')

                    @if(auth()->user()->role == 'سوبر')
                        <financial-groups-management :financial-groups="{{($FinancialGroups)}}" :first-lvl-accounts="{{$FirstLVLAccounts}}" ></financial-groups-management>
                    @else

                    @endif
              
@endsection

