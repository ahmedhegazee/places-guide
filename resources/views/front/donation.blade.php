@inject('bloodType', 'App\Models\BloodType')
@inject('governorate', 'App\Models\Government')
@extends('front.master')
@section('content')
<div class="container">
    <!--Breadcrumb-->
    <nav class="my-5" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">الرئيسيه</a></li>
            <li class="breadcrumb-item active" aria-current="page">طلبات التبرع</li>
        </ol>
    </nav>
</div>
<!--End container-->
<!--Donation-->
<section class="donation">
    <h2 class="text-center"><span class="py-1">طلبات التبرع</span> </h2>
    <hr />
    <div class="donation-request py-5">
        <div class="container">
            <form class="selection w-75 d-flex mx-auto my-4" action="{{ route('front.requests') }}" id="filter">

                @csrf
                <select class="custom-select" name="blood">
                    <option selected>اختر فصيلة الدم</option>
                    @foreach ($bloodType->all() as $blood)
                    <option value="{{ $blood->id }}">{{ $blood->name }}</option>
                    @endforeach
                    {{-- <option value="O-">O-</option>
                    <option value="A+">A+</option>
                    <option value="B+">B+</option> --}}
                </select>
                <select class="custom-select mx-md-3 mx-sm-1" onchange="getCities()" id="govern">
                    <option selected>اختر المحافظة</option>
                    @foreach ($governorate->all() as $govern)
                    <option value="{{ $govern->id }}">{{ $govern->name }}</option>
                    @endforeach
                    {{-- <option value="القاهرة">القاهرة</option>
                    <option value="الجيزة">الجيزة</option>
                    <option value="القليوبيه">القليوبيه</option>
                    <option value="سوهاج">سوهاج</option> --}}
                </select>
                <select class="custom-select mx-md-3 mx-sm-1" id="city" name="city">
                    <option selected>اختر المدينة</option>
                    {{-- @foreach ($governorate->all() as $govern)
                    <option value="{{ $govern->id }}">{{ $govern->name }}</option>
                    @endforeach --}}
                    {{-- <option value="القاهرة">القاهرة</option>
                    <option value="الجيزة">الجيزة</option>
                    <option value="القليوبيه">القليوبيه</option>
                    <option value="سوهاج">سوهاج</option> --}}
                </select>
                <div onclick="document.getElementById('filter').submit();"><i class="fas fa-search"></i></div>
            </form>
            <!--End selection-->
            @foreach ($records as $request)
            <div class="req-item my-3">
                <div class="row">
                    <div class="col-md-9 col-sm-12 clearfix">
                        <div class="blood-type m-1 float-right">
                            <h3>{{ $request->bloodType->name }}</h3>
                        </div>
                        <div class="mx-3 float-right pt-md-2">
                            <p>
                                اسم الحالة : {{ $request->name }}
                            </p>
                            <p>
                                مستشفى : {{ $request->address }}
                            </p>
                            <p>
                                المحافظة : {{ $request->city->government->name }}
                            </p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12 text-center p-sm-3 pt-md-5">
                        <a href="{{ route('front.requests-status',['request'=>$request->id]) }}"
                            class="btn btn-light px-5 py-3">التفاصيل</a>
                    </div>
                </div>
            </div>
            @endforeach

            <div class="row justify-content-center">
                {{ $records->links() }}
            </div>
        </div>
        <!--End container-->
    </div>
    <!--End Donation-request-->
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

               let defaultElement= $('#city').children().first();
                $('#city').empty();
                $(defaultElement).appendTo('#city');
            //    $(`<option selected="" disabled=""></option>`).appendTo('#city');
                cities.forEach(function(city){
                  $(`<option value=${city.id}>${city.name}</option>`).appendTo('#city');
                });
              })
            }
</script>
@endpush
