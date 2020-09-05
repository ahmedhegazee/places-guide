@inject('bloodTypes','App\Models\BloodType')
@inject('governs','App\Models\Government')
@extends('front.master')
@section('content')
<div class="container">
    <!--Breadcrumb-->
    <nav class="my-4" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">الرئيسيه</a></li>
            <li class="breadcrumb-item active" aria-current="page">انشاء طلب تبرع جديد</li>
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
            <form action="{{ route('front.donation.store') }}" class="w-75 m-auto" method="POST">
                @csrf
                <div><input type="text" name="name" class="form-control my-3 @error('name') is-invalid @enderror"
                        value="{{ old('name') }}" placeholder="الاسم"></div>
                <div><input type="number" name="no_blood_bags"
                        class="form-control my-3 @error('no_blood_bags') is-invalid @enderror"
                        value="{{ old('no_blood_bags') }}" placeholder="عدد اكياس الدم"></div>
                <div><input type="number" name="age" class="form-control my-3 @error('age') is-invalid @enderror"
                        value="{{ old('age') }}" placeholder="العمر"></div>
                <div><input type="text" name="address" class="form-control my-3 @error('address') is-invalid @enderror"
                        value="{{ old('address') }}" placeholder="عنوان المستشفى"></div>
                <div class="input-group mb-3">
                    <select class="form-control custom-select @error('blood_type_id') is-invalid @enderror"
                        name="blood_type_id" id="blood" required>
                        <option value="" disabled selected>اختيار فصيلة دم</option>
                        @foreach ($bloodTypes->all() as $bloodType)
                        <option value={{$bloodType->id}}>{{$bloodType->name}}</option>
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
                    <select class="form-control  custom-select" onchange="getCities()" value="" required
                        name="government_id" id="govern">
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
                        id="city" required>
                        <option selected="" disabled="">اختيار مدينة</option>
                    </select>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <input type="text" name="phone" value="{{ old('phone') }}"
                    class="form-control my-3 @error('phone') is-invalid @enderror" placeholder="رقم الهاتف">
                <div><textarea name="notes" class="form-control my-3 @error('notes') is-invalid @enderror"
                        placeholder="ملاحظات"> {{ old('notes') }}</textarea> </div>
                <button type="submit" class="btn btn-success py-2 w-50">ارسال</button>
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
