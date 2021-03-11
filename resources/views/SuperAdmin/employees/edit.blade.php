@extends('Layout')
@section('title')
    - تعديل موظف
@endsection
@section('PageHeader')
    تعديل بيانات موظف
    (
        {{$employee->name}}
    )
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('plugins/select2/select2.min.css')}}">
@endsection
@section('content')
    <form method="post" enctype='multipart/form-data' action="{{route('employees.update',$employee)}}"  style="padding-top:70px">
        @csrf
        @method('patch')
        <div class="row pb-4">
            <div class="col-lg-6 ">
                <label class="float-right">رقم الهوية</label>
                <input name="national_id" type="number" class="form-control"  style="padding-bottom: 20px" value="{{$employee->national_id}}"  placeholder="رقم الهوية">

            </div>
            @error('national_id')
            <div class="col-md-6">
                <div class="alert alert-danger mt-1">
                    <p class="text-sm">
                        {{ $message }}
                    </p>
                </div>
            </div>
            @enderror
            <div class="col-lg-6">
                <div class="form-group ">
                    <label class="float-right pt-4">تاريخ الهوية</label>
                    <input id="national_id_date" name="national_id_date" type="date" class="form-control pb-5" autocomplete="national_id_date" value="{{$employee->national_id_date}}" required>
                </div>
            </div>
            @error('national_id_date')
            <div class="col-md-6">
                <div class="alert alert-danger mt-1">
                    <p class="text-sm">
                        {{ $message }}
                    </p>
                </div>
            </div>
            @enderror
        </div>


        <div class="row" style="padding-bottom: 20px">

            <div class="col-lg-6 ">
                <div class="form-group ">
                    <label class="float-right">رقم الجوال</label>
                    <input name="phone" type="text" class="form-control pb-5" value="{{$employee->phone}}"  placeholder="رقم الجوال" required>
                </div>
                @error('phone')
                <div class="col-md-6">
                    <div class="alert alert-danger mt-1">
                        <p class="text-sm">
                            {{ $message }}
                        </p>
                    </div>
                </div>
                @enderror
            </div>
            <div class="col-lg-6 ">
                <label class="float-right">الوظيفة</label>
                <select name="role" class="form-control select2 select2-hidden-accessible pb-5" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                    <option selected>{{$employee->role}}</option>
                    <option value="سكرتير">سكرتير</option>
                    <option value="مدقق">مدقق</option>
                    <option value="مراجع فني">مراجع فني</option>
                    <option value="مدير مراجعة">مدير مراجعة</option>
                    <option value="سكرتير تنفيذي">سكرتير تنفيذي</option>
                    <option value="شريك اداري">شريك اداري</option>
                    <option value="مدير أداري">مدير أداري</option>

                </select>

            </div>
            @error('role')
            <div class="col-md-6">
                <div class="alert alert-danger mt-1">
                    <p class="text-sm">
                        {{ $message }}
                    </p>
                </div>
            </div>
            @enderror
        </div>
        <div class="row">
            <div class="col-lg-6 ">
                <div class="form-group ">
                    <label class="float-right">الأسم بالكامل</label>
                    <input name="name" type="text" class="form-control pb-5" value="{{$employee->name}}" placeholder="الأسم بالكامل" required>
                    @error('name')
                    <div class="col-md-6">
                        <div class="alert alert-danger mt-1">
                            <p class="text-sm">
                                {{ $message }}
                            </p>
                        </div>
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6  ">
                <div class="form-group ">
                    <label class="float-right">تاريخ الميلاد</label>
                    <input id="birth_date" name="birth_date" type="date" class="form-control pb-5" autocomplete="birth_date" value="{{$employee->birth_date}}" required>
                </div>
            </div>

            @error('birth_date')
            <div class="col-md-6">
                <div class="alert alert-danger mt-1">
                    <p class="text-sm">
                        {{ $message }}
                    </p>
                </div>
            </div>
            @enderror
        </div>

        <div class="row">
            <div class="col-lg-6  ">
                <div class="form-group ">
                    <label class="float-right">الإيميل</label>
                    <input name="email" type="email" class="form-control pb-5" value="{{$employee->email}}"  placeholder="الإيميل" required>
                </div>
            </div>
            @error('email')
            <div class="col-md-6">
                <div class="alert alert-danger mt-1">
                    <p class="text-sm">
                        {{ $message }}
                    </p>
                </div>
            </div>
            @enderror
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group ">

                    <label>الرمز</label>
                    <input name="code" class="form-control" value="{{$employee->code}}" placeholder="الرمز"  type="text" required>
                </div>
            </div>
        </div>
        <div class="row margin-bottom mt-20">
            <div class="form-group ">

                <div class="col-md-4">
                    <input ref="signature" name="signature" class="form-control" type="file" accept=".APNG,.AVIF,.GIF,.JPEG,.PNG,.SVG" >
                </div>

                <div class="col-md-3">
                    <img src="{{$employee->signatureImage}}" class="img-responsive">
                </div>
            </div>
        </div>
            <button type="submit" class="btn btn-block btn-warning btn-flat margin-bottom mt-20">تعديل بيانات الموظف</button>

    </form>
    <div class="row" style="margin-top: 20px">
        <div class="col-md-4">
            <button  data-toggle="modal" data-target="#DeleteWarning" class="btn btn-block btn-danger btn-flat">حذف الموظف</button>
        </div>
        <!-- Modal -->
        <div id="DeleteWarning" class="modal modal-large fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">حذف الموظف</h4>
                    </div>
                    <div class="modal-body row text-center">
                        <div class="col-md-6">
                            <button class="btn btn-flat btn-warning btn-lg " data-dismiss="modal">غلق</button>
                        </div>

                        <div class="col-md-6">
                            <form action="{{route('employees.destroy',$employee)}}" method="post">
                                @csrf
                                @method('delete')
                                 <button class="btn btn-flat btn-lg btn-danger"  type="submit" >حذف</button>
                            </form>

                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">غلق</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('plugins/select2/select2.full.min.js')}}"></script>
    <script>
        $(function () {
            //Initialize Select2 Elements
            $(".select2").select2();
        });
    </script>

@endsection
