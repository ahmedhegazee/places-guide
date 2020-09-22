@inject('governs','App\Models\Governorate')
@extends('front.master')
@section('content')
<div class="container">
    <!--Breadcrumb-->
    <nav class="my-4" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">الرئيسيه</a></li>
            <li class="breadcrumb-item active" aria-current="page">تغيير كلمة المرور</li>
        </ol>
    </nav>
    <!--End Breadcrumb-->
</div>
<!--End container-->
<section class="signup text-center">

    <div class="container">
        @include('partials.validation-errors')
        @include('flash::message')
        <div class="py-4 mb-4">
            <form action="{{ url('/change-password') }}" class="w-75 m-auto" method="POST">
                @csrf
                @method('put')

                <input type="password" name="old_password"
                    class="form-control my-3 @error('old_password') is-invalid @enderror"
                    placeholder=" كلمة المرور القديمة">
                <input type="password" name="password" class="form-control my-3 @error('password') is-invalid @enderror"
                    placeholder="كلمة المرور">
                <input type="password" name="password_confirmation"
                    class="form-control my-3 @error('password_confirmation') is-invalid @enderror"
                    placeholder="تأكيد كلمة المرور">
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
