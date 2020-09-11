<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" value="{{ csrf_token() }}" />
    <title>Laravel</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet" />
    <!-- CoreUI CSS -->
    <link rel="stylesheet" href="https://unpkg.com/@coreui/coreui/dist/css/coreui.min.css" crossorigin="anonymous">

</head>

<body>
    <div id="app" class="mt-5">
        <div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
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
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div>
            <app-component></app-component>
        </div>
        <div>
            <form-component></form-component>
        </div>
        <div>
            <example-component></example-component>
        </div>
    </div>

    <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
</body>

</html>