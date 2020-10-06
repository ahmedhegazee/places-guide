@inject('governs','App\Models\Governorate')
@extends('front.master')
@section('content')
<div class="container">
    <!--Breadcrumb-->
    <nav class="my-4" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">{{__('main.home')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{__('main.profile')}}</li>
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
            <form action="{{ url('/profile') }}" class="w-75 m-auto" method="POST">
                @csrf
                @method('put')
                <div><input type="text" name="full_name"
                        class="form-control my-3 @error('full_name') is-invalid @enderror"
                        value="{{ $client->full_name??old('full_name') }}" placeholder="{{__('main.name')}}"></div>
                <div><input type="email" name="email" class="form-control my-3 @error('email') is-invalid @enderror"
                        value="{{ $client->email??old('email') }}" placeholder="{{__('main.email')}}"></div>
                <div class="input-group mb-3">
                    <select class="form-control  custom-select" onchange="getCities()" value="" name="govern"
                        id="govern">
                        <option selected="" disabled="">{{__('main.choose govern orate')}}</option>
                        @foreach ($governs->all() as $govern)
                        <option value={{$govern->id}}
                            {{ auth('clients')->user()->city->governorate->id==$govern->id?'selected':'' }}>
                            {{$govern->name}}</option>
                        @endforeach
                    </select>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="input-group">
                    <select class="form-control @error('city_id') is-invalid @enderror custom-select" name="city_id"
                        id="city">
                        <option selected="" disabled="">{{__('main.choose city')}}</option>
                        @forelse (auth('clients')->user()->city->governorate->cities as $city)
                        <option value={{$city->id}} {{ auth('clients')->user()->city->id==$city->id?'selected':'' }}>
                            {{$city->name}}</option>
                        @empty

                        @endforelse
                    </select>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <input type="text" name="phone" value="{{ $client->phone??old('phone') }}"
                    class="form-control my-3 @error('phone') is-invalid @enderror" placeholder="{{__('main.phone')}}">
                {{-- <input type="password" name="password" class="form-control my-3 @error('password') is-invalid @enderror"
                    placeholder="كلمة المرور">
                <input type="password" name="password_confirmation"
                    class="form-control my-3 @error('password_confirmation') is-invalid @enderror"
                    placeholder="تأكيد كلمة المرور"> --}}
                <button type="submit" class="btn btn-success py-2 w-50">{{__('main.update')}}</button>
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
