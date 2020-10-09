<!DOCTYPE html>
<html @if (app()->getLocale()=='ar')
dir="rtl"
@endif>
{{-- dir="rtl" --}}

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Places Guide</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/rtl.css') }}">
    @yield('additional_styles')
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>


        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="brand-link">
                <img src="{{ asset('adminlte/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Places Guide</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('adminlte/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <a href="{{ route('home') }}" class="d-block">{{ auth()->user()->name }}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="{{ route('client.index') }}"
                                class="nav-link {{ Route::currentRouteName()=='client.index'?'active':'' }}">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    {{ __('pages.Clients') }}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('place-owner.index') }}"
                                class="nav-link {{ Route::currentRouteName()=='place-owner.index'?'active':'' }}">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    {{ __('pages.Owners') }}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('owner-request.index') }}"
                                class="nav-link {{ Route::currentRouteName()=='owner-request.index'?'active':'' }}">
                                <i class="nav-icon fas fa-user-plus"></i>
                                <p>
                                    {{ __('pages.Owner Requests') }}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('place.index') }}"
                                class="nav-link {{ Route::currentRouteName()=='place.index'?'active':'' }}">
                                <i class="nav-icon fas fa-building"></i>
                                <p>
                                    {{ __('pages.Companies') }}
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('government.index') }}"
                                class="nav-link {{ Route::currentRouteName()=='government.index'?'active':'' }}">
                                <i class="nav-icon fas fa-university"></i>
                                <p>
                                    {{ __('pages.Governments') }}

                                </p>
                            </a>
                        </li>

                        <li
                            class="nav-item currentRouteName-treeview {{ Route::currentRouteName()=='category.index'||Route::currentRouteName()=='category.index'?'menu-open':'' }}">
                            <a href="#" class="nav-link ">
                                <i class="nav-icon fas fa-bookmark"></i>
                                <p>
                                    {{ __('pages.Categories') }}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview"
                                style="display: {{ Route::currentRouteName()=='category.index'||Route::currentRouteName()=='worker-category.index'?'block':'none' }};">
                                <li class="nav-item">
                                    <a href="{{ route('category.index') }}"
                                        class="nav-link {{ Route::currentRouteName()=='category.index'?'active':'' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('pages.Companies') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('worker-category.index') }}"
                                        class="nav-link {{ Route::currentRouteName()=='worker-category.index'?'active':'' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('pages.Workers Jobs') }}</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        {{-- <li class="nav-item">
                            <a href="{{ route('message.index') }}"
                        class="nav-link {{ Route::currentRouteName()=='message.index'?'active':'' }}">
                        <i class="nav-icon fas fa-envelope"></i>
                        <p>
                            {{ __('pages.Client Messages') }}

                        </p>
                        </a>
                        </li> --}}
                        <li class="nav-item">
                            <a href="{{ route('dashboard.work-ad.index') }}"
                                class="nav-link {{ Route::currentRouteName()=='dashboard.work-ad.index'?'active':'' }}">
                                <i class="nav-icon fas fa-briefcase"></i>
                                <p>
                                    {{ __('pages.Work Ads') }}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dashboard.discount.index') }}"
                                class="nav-link {{ Route::currentRouteName()=='dashboard.discount.index'?'active':'' }}">
                                <i class="nav-icon fas fa-percent"></i>
                                <p>
                                    {{ __('pages.Discounts') }}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('banner.index') }}"
                                class="nav-link {{ Route::currentRouteName()=='banner.index'?'active':'' }}">
                                <i class="nav-icon fas fa-ad"></i>
                                <p>
                                    {{ __('main.Banners') }}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user.index') }}"
                                class="nav-link {{ Route::currentRouteName()=='user.index'?'active':'' }}">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    {{ __('pages.Users') }}

                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('role.index') }}"
                                class="nav-link {{ Route::currentRouteName()=='role.index'?'active':'' }}">
                                <i class="nav-icon fas fa-user-tag"></i>
                                <p>
                                    {{ __('pages.Roles') }}

                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('setting.index') }}"
                                class="nav-link {{ Route::currentRouteName()=='setting.index'?'active':'' }}">
                                <i class="nav-icon fas fa-cogs"></i>
                                <p>
                                    {{ __('pages.Settings') }}

                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('page.index') }}"
                                class="nav-link {{ Route::currentRouteName()=='page].index'?'active':'' }}">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p>
                                    {{ __('pages.Pages Content') }}

                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('change-password-form') }}"
                                class="nav-link {{ Route::currentRouteName()=='change-password-form'?'active':'' }}">
                                <i class="nav-icon fas fa-key"></i>
                                <p>

                                    {{ __('pages.Change Password') }}

                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>
                                    {{ __('pages.Logout') }}

                                </p>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>@yield('page_title')</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            @yield('content')
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            {{-- <div class="float-right d-none d-sm-block"><b>Version</b> 1.0</div> --}}
            <strong>Copyright &copy; 2020
                <a href="#">Places Guide</a>.</strong>
            Developed By Ahmed Hegazy.
            All rights reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('adminlte/plugins/js/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('adminlte/plugins/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('adminlte/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('adminlte/js/demo.js') }}"></script>
    @yield('additional_scripts')
</body>

</html>
