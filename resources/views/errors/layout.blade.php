@extends('front.master')

@section('content')


<!-- Main content -->
<section class="content">
    <div class="error-page">
        <h2 class="headline text-warning"> @yield('code')</h2>

        <div class="error-content">
            <h3><i class="fas fa-exclamation-triangle text-warning"></i> @yield('short-message')</h3>

            <p>
                @yield('long-message')
            </p>


        </div>
        <!-- /.error-content -->
    </div>
    <!-- /.error-page -->
</section>
<!-- /.content -->

@endsection
