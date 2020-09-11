<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>BulletinBoard</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href=" {{ asset('/custom/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- CoreUI CSS -->
    <link rel="stylesheet" href="https://unpkg.com/@coreui/coreui/dist/css/coreui.min.css" crossorigin="anonymous">

    <!-- Custom styles for this template-->
    <!-- <link href="{{ asset('/custom/css/sb-admin-2.min.css')}}" rel="stylesheet"> -->

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

</head>

<body>
    <!-- <div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
        <div class="c-sidebar-brand d-md-down-none">
            <svg class="c-sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
                <use xlink:href="assets/brand/coreui-pro.svg#full"></use>
            </svg>
            <svg class="c-sidebar-brand-minimized" width="46" height="46" alt="CoreUI Logo">
                <use xlink:href="assets/brand/coreui-pro.svg#signet"></use>
            </svg>
        </div>
        <ul class="c-sidebar-nav ps ps--active-y">
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link c-active" href="main.html">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-speedometer"></use>
                    </svg> BulletinBoard</a></li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="colors.html">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-drop1"></use>
                    </svg> 
                    Colors
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="typography.html">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-pencil"></use>
                    </svg> 
                    Typography
                </a>
            </li>
        </ul>
    </div> -->
    <div id="app" class="c-body c-app align-items-center">
        @include('includes.navbar')
        <main class="py-4 c-main">
            @yield('content')
        </main>
    </div>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/@coreui/coreui/dist/js/coreui.min.js"></script>
    @stack('scripts')
</body>

</html>