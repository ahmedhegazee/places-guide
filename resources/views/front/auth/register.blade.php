@extends('front.master')
<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
    value="{{ old('name') }}" required autocomplete="name" autofocus>
@section('content')
<div class="container">
    <!--Breadcrumb-->
    <nav class="my-4" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">الرئيسيه</a></li>
            <li class="breadcrumb-item active" aria-current="page">انشاء حساب جديد</li>
        </ol>
    </nav>
    <!--End Breadcrumb-->
</div>
<!--End container-->
<section class="signup text-center">
    @include('partials.validation-errors')
    <div class="container">
        <div class="py-4 mb-4">
            <form action="" class="w-75 m-auto">
                <div><input type="text" name="name" class="form-control my-3 @error('name') is-invalid @enderror"
                        value="{{ old('name') }}" placeholder="الاسم"></div>
                <div><input type="mail" name="email" class="form-control my-3 @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" placeholder="البريد الاليكترونى"></div>
                <div class="input-group">
                    <input type="text" id="datepicker" name="dob"
                        class="form-control @error('dob') is-invalid @enderror" placeholder="تاريخ الميلاد">
                    <i class="far fa-calendar-alt"></i>
                </div>
                <input type="text" name="booldType" class="form-control my-3" placeholder="فصيلة الدم">
                <div class="input-group mb-3">
                    <select name="capital" id="capital" class="form-control custom-select">
                        <option>المحافظة</option>
                        <option value="القاهرة">القاهرة</option>
                        <option value="القليوبيه">القليوبية</option>
                        <option value="سوهاج">سوهاج</option>
                    </select>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="input-group">
                    <select name="city" id="city" class="form-control custom-select">
                        <option selected>المدينة</option>
                        <option value="القاهرة">الدقى</option>
                        <option value="بنها">بنها</option>
                        <option value="سوهاج">سوهاج</option>
                    </select>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <input type="text" name="phone" value="{{ old('phone') }}"
                    class="form-control my-3 @error('phone') is-invalid @enderror" placeholder="رقم الهاتف">
                <div class="input-group mb-3">
                    <input type="text" id="datepicker" name="last_donation_date"
                        class="form-control @error('last_donation_date') is-invalid @enderror"
                        placeholder="اخر تاريخ تبرع" aria-label="Username" aria-describedby="basic-addon1">
                    <i class="far fa-calendar-alt"></i>
                </div>
                <input type="password" name="password" class="form-control my-3 @error('password') is-invalid @enderror"
                    placeholder="كلمة المرور">
                <input type="password" name="password_confirmation"
                    class="form-control my-3 @error('password_confirmation') is-invalid @enderror"
                    placeholder="تأكيد كلمة المرور">
                <button type="submit" class="btn btn-success py-2 w-50">ارسال</button>
            </form>
        </div>
    </div>
</section>
@endsection
