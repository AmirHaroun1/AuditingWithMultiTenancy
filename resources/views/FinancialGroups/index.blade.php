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
    <div  style="padding-top: 50px">
        <div class="row">
            <div class="col-md-12">
                <div id="app">

                    @if(auth()->user()->role == 'سوبر')
                        <financial-groups-management :financial-groups="{{($FinancialGroups)}}" :first-lvl-accounts="{{$FirstLVLAccounts}}" ></financial-groups-management>
                    @else

                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

    <script src="{{ asset('js/app.js')}}"></script>

@endsection
