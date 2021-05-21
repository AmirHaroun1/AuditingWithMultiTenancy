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
@section('content')
                    @if(auth()->user()->role == 'سكرتير')
                        <secretary-transactions-table></secretary-transactions-table>
                        @elseif(auth()->user()->role == 'مراجع فني')
                        <reviser-transactions-table></reviser-transactions-table>
                        @elseif(auth()->user()->role == 'مدقق')
                        <auditor-transactions-table></auditor-transactions-table>
                        @elseif(auth()->user()->role == 'مدير مراجعة')
                        <revising-manager-transactions-table></revising-manager-transactions-table>
                        @elseif(auth()->user()->role == 'شريك اداري')
                        <partner-transactions-table></partner-transactions-table>
                        @elseif(auth()->user()->role == 'سكرتير تنفيذي')
                        <archive-transactions-table></archive-transactions-table>
                    @endif
@endsection

