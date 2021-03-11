@extends('Layout')

@section('body')
    <div class="login-box" id="login-box">
        <div class="login-logo">تسجيل حساب كـعميل جديد</div>
        <form action="{{route('register')}}" method="post">
            @csrf
            <div class="login-box-body bg-gray">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        <input type="email" name="email" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror" placeholder="البريد الألكترونى" required autocomplete="email">
                    </div>
                    @error('email')
                    <div class="alert alert-danger mt-3">
                        <p class="text-sm">
                            {{ $message }}
                        </p>
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" name="name" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror" placeholder="الأسم كامل" required autocomplete="name">
                    </div>
                    @error('name')
                    <div class="alert alert-danger mt-3">
                        <p class="text-sm">
                            {{ $message }}
                        </p>
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                        <input name="password" type="password" class="form-control" placeholder="الرقم السرى" required>
                    </div>
                    @error('password')
                    <div class="alert alert-danger mt-3">
                        <p class="text-sm">
                            {{ $message }}
                        </p>
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                        <input name="password_confirmation" type="password" class="form-control" placeholder=" تأكيد الرقم السرى" required>
                    </div>
                </div>
            </div>
            <div class="footer text-center">
                <button type="submit" class="btn bg-olive btn-block">تسجيل حساب كـعميل جديد</button>

            </div>
        </form>

    </div>
@endsection
