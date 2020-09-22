<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" value="{{ csrf_token() }}" />
    <title>Laravel</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet" />
    <!-- Custom fonts for this template-->
    <link href=" {{ asset('/custom/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- CoreUI CSS -->
    <link rel="stylesheet" href="https://unpkg.com/@coreui/coreui/dist/css/coreui.min.css" crossorigin="anonymous">
    
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

</head>

<body>
    <div id="app" class="mt-5">
        <div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
            <div class="c-sidebar-brand d-md-down-none">
                <div class="c-sidebar-brand-full text-center">
                    BulletinBoard
                </div>
                <div class="c-sidebar-brand-minimized">
                    BulletinBoard
                </div>
            </div>
            <side-bar :app="{{ json_encode(Auth::user()) }}"></side-bar>
        </div>
        <div class="c-wrapper">
            <!-- <header class="c-header c-header-light c-header-fixed">
                <ol class="breadcrumb border-0 m-0 px-0 px-md-3">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>  
            </header> -->
            <div class="c-body">
                <main class="c-main">
                    <div class="container-fluid">
                        <div id="ui-view">
                            <div>
                                <link href="vendors/@coreui/chartjs/css/coreui-chartjs.css" rel="stylesheet">
                                <div class="fade-in">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <app-component></app-component>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
    <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
</body>

</html>