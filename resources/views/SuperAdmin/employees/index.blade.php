@extends('Layout')
@section('title')
    - الموظفين
@endsection
@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}">
@endsection
@section('PageHeader')
    تكويد الموظفين
@endsection

@section('content')
    <div  style="padding-top: 50px">
        <div class="row">
           <div class="col-md-12">
               <div class="box">
                   <div class="box-header">
                       <h2 class="box-title pb-3">جدول الموظفين</h2>
                   </div>
                   <!-- /.box-header -->
                         <div class="box-body">

                           <div class="col-md-12">
                               <a class="btn btn-block btn-success btn-md" href="{{route('employees.create')}}">أضافة موظف جديد</a>
                           </div>

                       <div id="tableWrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                          <div class="row">
                              <div class="col-sm-12">
                                  <table id="employees_table" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                       <thead>
                                       <tr role="row">
                                           <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="الأسم/الصفحة" aria-sort="ascending" style="width: 176px;">الأسم/الصفحة</th>
                                           <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="الوظيفة" style="width: 223px;">الوظيفة</th>
                                           <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="رقم الجوال" style="width: 205px;">رقم الجوال</th>
                                           <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 152px;">الأيميل</th>
                                       </tr>
                                       </thead>
                                       <tbody>
                                       @foreach($employees as $employee)
                                           <tr role="row" class="odd">
                                               <td class="sorting_1"><a href="{{route('employees.edit',$employee)}}">{{$employee->name}}</a></td>
                                               <td>{{$employee->role}}</td>
                                               <td>{{$employee->phone}}</td>
                                               <td>{{$employee->email}}</td>
                                           </tr>
                                        @endforeach

                                       </tbody>

                                   </table>
                               </div>
                           </div>
                           <div class="row">
                               <div class="col-md-7">
                                   {{$employees->links()}}
                               </div>
                           </div>

                       </div>
                   </div>
                         </div>
                     <!-- /.box-body -->
               </div>
           </div>
        </div>

@endsection
@section('scripts')


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
