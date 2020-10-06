@inject('governs','App\Models\Governorate')
@extends('front.master')
@section('content')
<div class="container">
    <!--Breadcrumb-->
    <nav class="my-4" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">{{__('main.home')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{__('main.register')}}</li>
        </ol>
    </nav>
    <!--End Breadcrumb-->
</div>
<!--End container-->
<section class="signup text-center">
    @include('partials.validation-errors')
    <div class="container">
        <div class="py-4 mb-4">
            <form action="{{ url('/register') }}" class="w-75 m-auto" method="POST">
                @csrf
                <div><input type="text" name="name" class="form-control my-3 @error('name') is-invalid @enderror"
                        value="{{ old('name') }}" placeholder="{{__('main.name')}}"></div>
                <div><input type="email" name="email" class="form-control my-3 @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" placeholder="{{__('main.email')}}"></div>
                {{-- <input type="text" name="booldType" class="form-control my-3" placeholder="فصيلة الدم"> --}}
                <div class="input-group mb-3">
                    {{-- <select name="capital" id="capital" class="form-control custom-select">
                        <option>المحافظة</option>
                        <option value="القاهرة">القاهرة</option>
                        <option value="القليوبيه">القليوبية</option>
                        <option value="سوهاج">سوهاج</option>
                    </select> --}}
                    <select class="form-control  custom-select" onchange="getCities()" value="" required name="govern"
                        id="govern">
                        <option selected="" disabled="">{{__('main.choose govern orate')}}</option>
                        @foreach ($governs->all() as $govern)
                        <option value={{$govern->id}}>{{$govern->name[app()->getLocale()]}}</option>
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
                        id="city" required>
                        <option selected="" disabled="">{{__('main.choose city')}}</option>
                    </select>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <input type="text" name="phone" value="{{ old('phone') }}"
                    class="form-control my-3 @error('phone') is-invalid @enderror" placeholder="{{__('main.phone')}}">
                <input type="password" name="password" class="form-control my-3 @error('password') is-invalid @enderror"
                    placeholder="{{__('main.password')}}">
                <input type="password" name="password_confirmation"
                    class="form-control my-3 @error('password_confirmation') is-invalid @enderror"
                    placeholder="{{__('main.confirm password')}}">
                <button type="submit" class="btn btn-success py-2 w-50">{{__('main.send')}}</button>
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
