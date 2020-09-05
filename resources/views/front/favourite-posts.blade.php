@extends('front.master')
@section('content')
<div class="container">
    <!--Breadcrumb-->
    <nav class="my-5" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">الرئيسيه</a></li>
            <li class="breadcrumb-item active" aria-current="page">المقالات المفضلة</li>
            {{-- <li class="breadcrumb-item active" aria-current="page">{{ $post->title }}</li> --}}
        </ol>
    </nav>
    <!--End Breadcrumb-->
</div>
<!--End container-->
@foreach ($favouritePosts as $favouritePost)
<section class="artice-detailes pb-5" id="post-{{$favouritePost->id }}">
    <div class="container">
        <div class="article-img m-auto">
            <img src="{{ asset($favouritePost->photo) }}" class="card-img-top" alt="article-img">
        </div>
        <div class="article-content my-4">
            <div class="article-header p-2 d-flex justify-content-between">
                <h6>{{ $favouritePost->title }}</h6>
                <div class="heart-icon" data-post="{{ $favouritePost->id }}"><i
                        class="{{ auth('client')->user()->favouritePosts->contains($favouritePost->id)?'fas':'far' }} fa-heart"></i>
                </div>
            </div>
            <div class="article-details p-4">
                <p class="my-md-4">
                    {{ $favouritePost->content }}
                </p>

            </div>
        </div>
    </div>
</section>
@endforeach
<div class="row justify-content-center mb-2">
    {{ $posts->links() }}
</div>
<!--Articles section-->
{{-- <section class="articles mb-5">
    <div class="title">
        <div class="container">
            {{-- <h5><span class="py-1">مقالات ذات صلة</span> </h5> --}}
{{-- </div>
</div>  --}}
{{-- <div class="article-slide mt-3">
        <div class="container">
            <div class="arrow text-left">
                <button type="button" class="prev-arrow px-2 py-1"><i class="fas fa-chevron-right"></i></button>
                <button type="button" class="next-arrow px-2 py-1"><i class="fas fa-chevron-left"></i></button>
            </div>
            <div class="slick2">
                @foreach ($favouritePosts as $favouritePost)


                <div class="slick-cont">
                    <div class="card">
                        <img src="{{ $favouritePost->photo }}" class="card-img-top" alt="slick-img">
@auth('client')
<div class="heart-icon"><i
        class="{{ auth('client')->user()->favouritePosts->contains($favouritePost->id)?'fas':'far' }} fa-heart"></i>
</div>
@endauth
<div class="card-body">
    <h5 class="card-title">{{ $favouritePost->title }}</h5>
    <p style="overflow: hidden;height:110px;">{{ $favouritePost->content }}
    </p>
    <div class="text-center"><a href="{{ route('front.post',['post'=>$favouritePost->id]) }}"
            class="btn bg px-5">التفاصيل</a>
    </div>
</div>
</div>
</div>
@endforeach
</div>
</div>
</div> --}}
<!--End container-->
</section>
<!--End Articles-->
@endsection
@push('scripts')
<script>
    $('.heart-icon').click(function () {
            var icon = $(this).find('i');
            let post = $(this).attr('data-post');
            let token = $('input[name="_token"]').val();
            $.ajax({
            url:'/favourite/post',
            type:'post',
            data:{
                post:post,
                _token:token
            },
            success:function(response){
                if ($(this).hasClass('fas')) {
                $(this).removeClass('fas').addClass('far');
                // $('#post-'+post).remove();
                } else {
                $(this).removeClass('far').addClass('fas');
                }
            }
            });
        });

</script>
@endpush
@push('styles')
<style>
    .article-header {
        position: relative
    }
</style>
@endpush
