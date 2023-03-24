<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="{{ asset('assets/libs/toastr/toastr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/bootstrap-select/bootstrap-select.min.css') }}"
        rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/libs/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-select/bootstrap-select.min.js') }}"></script>

    <!-- Fonts -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Page specific Styles -->
    @stack('styles')
</head>

<body>
    <div class="wrapper">

        <!-- Navbar -->
        <header class="site-navbar site-navbar-target" role="banner">
            <div class="container-fluid">
                <div class="row align-items-center position-relative">
                    <div class="col-3">
                        <div class="site-logo">
                            <a href="{{ route('home') }}" class="font-weight-bold">Subscriber
                                Manager</a>
                        </div>
                    </div>
                    <div class="col-9  text-right">
                        <nav class="site-navigation text-right ml-auto d-none d-lg-block" role="navigation">
                            <ul class="site-menu main-menu js-clone-nav ml-auto ">
                                <li><a href="{{ route('subscribers.list') }}"
                                        class="nav-link {{ request()->is('subscribers') ? 'active' : '' }}">Subscribers</a></li>
                                <li><a href="{{ route('settings.index') }}" class="nav-link {{ request()->is('settings') ? 'active' : '' }}">Settings</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                @yield('content')
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
    </div>
    <!-- ./wrapper -->

    <footer class="main-footer">
        <strong>All rights reserved. Copyright &copy; 2023. Developed by
            <a href="https://linkedin.com/in/mrehsanellahi">Ahsan Ellahi</a></strong>
        <div class="float-right">
            <b>Version</b> 1.0
        </div>
    </footer>

    <!-- Page specific Scripts -->

    @include('components.scripts.toastr')

    @stack('scripts')

</body>

</html>
