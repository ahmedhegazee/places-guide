@inject('bloodTypes','App\Models\BloodType')
@inject('governs','App\Models\Government')
@extends('front.master')
@section('content')
<div class="container">
    <!--Breadcrumb-->
    <nav class="my-4" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">الرئيسيه</a></li>
            <li class="breadcrumb-item active" aria-current="page">تعديل بيانات حساب</li>
        </ol>
    </nav>
    <!--End Breadcrumb-->
</div>
<!--End container-->
<section class="signup text-center">
    @include('partials.validation-errors')
    @include('flash::message')
    <div class="container">
        <div class="py-4 mb-4">
            <form action="{{ url('/profile') }}" class="w-75 m-auto" method="POST">
                @csrf
                @method('put')
                <div><input type="text" name="name" class="form-control my-3 @error('name') is-invalid @enderror"
                        value="{{ $client->name??old('name') }}" placeholder="الاسم"></div>
                <div><input type="email" name="email" class="form-control my-3 @error('email') is-invalid @enderror"
                        value="{{ $client->email??old('email') }}" placeholder="البريد الاليكترونى"></div>
                <div class="input-group mb-3">
                    <input type="date" id="dob" name="dob" class="form-control @error('dob') is-invalid @enderror"
                        value="{{ $client->dob??old('dob') }}" placeholder="تاريخ الميلاد">
                    {{-- <i class="far fa-calendar-alt"></i> --}}
                </div>
                <div class="input-group mb-3">
                    <select class="form-control custom-select @error('blood_type_id') is-invalid @enderror"
                        name="blood_type_id" id="blood" required>
                        <option value="" disabled selected>اختيار فصيلة دم</option>
                        @foreach ($bloodTypes->all() as $bloodType)
                        <option value={{$bloodType->id}} selected="{{ $client->blood_type_id==$bloodType->id }}">
                            {{$bloodType->name}}</option>
                        @endforeach
                    </select>
                    <i class="fas fa-chevron-down"></i>
                </div>
                {{-- <input type="text" name="booldType" class="form-control my-3" placeholder="فصيلة الدم"> --}}
                <div class="input-group mb-3">
                    {{-- <select name="capital" id="capital" class="form-control custom-select">
                        <option>المحافظة</option>
                        <option value="القاهرة">القاهرة</option>
                        <option value="القليوبيه">القليوبية</option>
                        <option value="سوهاج">سوهاج</option>
                    </select> --}}
                    <select class="form-control  custom-select" onchange="getCities()" value="" name="govern"
                        id="govern">
                        <option selected="" disabled="">اختيار المحافظة</option>
                        @foreach ($governs->all() as $govern)
                        <option value={{$govern->id}}>{{$govern->name}}</option>
                        @endforeach
                    </select>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="input-group">
                    {{-- <select name="city" id="city" class="form-control custom-select">
                        <option selected>المدينة</option>
                        <option value="القاهرة">الدقى</option>
                        <option value="بنها">بنها</option>
                        <option value="سوهاج">سوهاج</option>
                    </select> --}}
                    <select class="form-control @error('city_id') is-invalid @enderror custom-select" name="city_id"
                        id="city">
                        <option selected="" disabled="">اختيار مدينة</option>
                    </select>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <input type="text" name="phone" value="{{ $client->phone??old('phone') }}"
                    class="form-control my-3 @error('phone') is-invalid @enderror" placeholder="رقم الهاتف">
                <div class="input-group mb-3">
                    <input type="date" id="last_donation_date" name="last_donation_date"
                        class="form-control @error('last_donation_date') is-invalid @enderror"
                        placeholder="اخر تاريخ تبرع" aria-label="Username"
                        value="{{ $client->last_donation_date??old('last_donation_date') }}"
                        aria-describedby="basic-addon1">
                    {{-- <i class="far fa-calendar-alt"></i> --}}
                </div>
                {{-- <input type="password" name="password" class="form-control my-3 @error('password') is-invalid @enderror"
                    placeholder="كلمة المرور">
                <input type="password" name="password_confirmation"
                    class="form-control my-3 @error('password_confirmation') is-invalid @enderror"
                    placeholder="تأكيد كلمة المرور"> --}}
                <button type="submit" class="btn btn-success py-2 w-50">تحديث</button>
            </form>
        </div>
    </div>
</section>
@endsection
@push('scripts')
<script>
    function getCities(){
              let govern = $('#govern').val();
            //   console.log(govern);

              $.ajax({
                url:`${location.origin}/api/v1/cities?govern=${govern}`
              }).done(function(data){
                let cities = data.data;
               $('#city').empty();
               $(`<option selected="" disabled="">اختيار مدينة</option>`).appendTo('#city');
                cities.forEach(function(city){
                  $(`<option value=${city.id}>${city.name}</option>`).appendTo('#city');
                });
              })
            }
</script>
@endpush
@push('styles')
<style>
    select.form-control:not([size]):not([multiple]) {
        height: calc(2.25rem + 5px);
        padding: 8px;
    }

    .fa-chevron-down {
        top: 15px !important;
    }
</style>
@endpush
