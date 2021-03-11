@extends('Layout')
@section('title')
    - أضافة موظف
@endsection
@section('PageHeader')
أضافة موظف
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('plugins/select2/select2.min.css')}}">
@endsection
@section('content')
    <form enctype='multipart/form-data' action="{{route('employees.store')}}" method="POST" style="padding-top:70px">
        @csrf
        <div class="row">
            <div class="col-lg-6 ">
                <label class="float-right">رقم الهوية</label>
                <input name="national_id" type="number" class="form-control pb-4" autocomplete="national_id" style="padding-bottom: 20px" value="{{old('national_id')}}"  placeholder="رقم الهوية">

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
                        <input name="national_id_date" type="date" class="form-control pb-5" autocomplete="national_id_date" value="{{old('national_id_date')}}" >
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
                    <input name="phone" type="text" class="form-control pb-5" autocomplete="phone" value="{{old('phone')}}"  placeholder="رقم الجوال" >
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
                    <option selected disabled>-- أختر وظيفة -- </option>
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
                   <input name="name" type="text" class="form-control pb-5" autocomplete="name" value="{{old('name')}}"  placeholder="الأسم بالكامل" required>
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
                    <input name="birth_date" type="date" class="form-control pb-5" autocomplete="birth_date" value="{{old('birth_date')}}" >
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
                    <input name="email" type="email" class="form-control pb-5" autocomplete="email" value="{{old('email')}}"  placeholder="الإيميل" required>
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

        <div class="row pb-4">
            <div class="col-lg-6  ">
                <div class="form-group ">
                    <label class="float-right">الرقم السرى</label>
                    <input name="password" type="password" class="form-control pb-5"  placeholder="الرقم السرى" required>
                </div>
            </div>
            @error('password')
                <div class="col-md-6">
                    <div class="alert alert-danger mt-1">
                        <p class="text-sm">
                            {{ $message }}
                        </p>
                    </div>
                </div>
            @enderror
        </div>
        <div class="row pb-4">
            <div class="col-lg-6  ">
                <div class="form-group ">
                    <label class="float-right"> تأكيد الرقم الرقم السرى</label>
                    <input name="password_confirmation" type="password" class="form-control"  placeholder=" تأكيد الرقم السرى" required>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group ">

                    <label>الرمز</label>
                    <input name="code" class="form-control" placeholder="الرمز"  type="text" required>
                </div>
            </div>
        </div>
        <div class="row margin-bottom mt-20">
            <div class="form-group ">

                <div class="col-md-4">
                    <input ref="signature" name="signature" class="form-control" type="file" accept=".APNG,.AVIF,.GIF,.JPEG,.PNG,.SVG" >
                </div>

            </div>
        </div>
        <button class="btn btn-block btn-success btn-flat">أضافة موظف</button>
    </form>
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
