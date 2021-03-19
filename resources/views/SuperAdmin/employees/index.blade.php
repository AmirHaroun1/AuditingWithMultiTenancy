@extends('Layout')
@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}">
@endsection
@section('content')
    <manage-employees  employees="{{json_encode($employees)}}" />
@endsection
@section('scripts')

    <script src="{{ asset('js/app.js')}}"></script>
    <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/datatables/dataTables.bootstrap.min.js')}}"></script>

    <!-- page script -->
    <script>
        $(function () {

                $('#employees_table').DataTable({
                    "paging": false,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": false,
                    "autoWidth": false,
                    "oLanguage": {

                        "sSearch": "أبحث بالأسم / رقم الجوال / الوظيفة"

                    }
                });
            });

    </script>
    @endsection
