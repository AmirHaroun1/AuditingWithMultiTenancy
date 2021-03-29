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
                        <revising-guid-management :All-Revising-Guides="{{$AllRevisingGuides}}"></revising-guid-management>
                    @elseif(auth()->user()->role == 'سكرتير تنفيذي')
                        <archive-edit-transaction :Transaction="{{$Transaction}}"></archive-edit-transaction>

                    @endif
            
@endsection
@section('scripts')

    <script src="{{ asset('js/app.js')}}"></script>

@endsection
