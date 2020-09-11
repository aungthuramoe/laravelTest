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

<body class="c-app">
    <div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show c-sidebar-show" id="app">
        <div class="c-sidebar-brand d-md-down-none">
            <div class="c-sidebar-brand-full text-center">
                BulletinBoard
            </div>
            <div class="c-sidebar-brand-minimized">
                BulletinBoard
            </div>
        </div>
        <!-- <ul class="c-sidebar-nav ps ps--active-y">
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="colors.html">
                    Dashboard
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="colors.html">
                    All Posts
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="colors.html">
                    User
                </a>
            </li>
        </ul> -->
        <side-bar></side-bar>
    </div>
    <div class="c-wrapper">
        <header class="c-header c-header-light c-header-fixed">
            <!-- <div class="c-subheader justify-content-between px-3">
                <ol class="breadcrumb border-0 m-0 px-0 px-md-3">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div> -->
        </header>
        <div class="c-body">
            <main class="c-main">
                <div class="container-fluid">
                    <div id="ui-view">
                        <div>
                            <link href="vendors/@coreui/chartjs/css/coreui-chartjs.css" rel="stylesheet">
                            <div class="fade-in">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header">Post Lists</div>
                                            <div class="card-body">
                                                <table class="table table-responsive-sm table-hover table-outline mb-0">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th scope="col">Title</th>
                                                            <th scope="col">Description</th>
                                                            <th scope="col">Status</th>
                                                            <th scope="col">Posted User</th>
                                                            <th scope="col">Posted Date</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <div>Info</div>
                                                            </td>
                                                            <td>
                                                                <div>Info</div>
                                                            </td>
                                                            <td>
                                                                <strong>Info</strong>
                                                            </td>
                                                            <td>
                                                                <strong>Info</strong>
                                                            </td>
                                                            <td>
                                                                <strong>Info</strong>
                                                            </td>
                                                            <td>
                                                                <strong>action</strong>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>


    <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
    <script src="vendors/@coreui/coreui-pro/js/coreui.bundle.min.js"></script>
    <!--[if IE]><!-->
    <script src="vendors/@coreui/icons/js/svgxuse.min.js"></script>
    <!--<![endif]-->
    <script>
        new coreui.AsyncLoad(document.getElementById('ui-view'));
        var tooltipEl = document.getElementById('header-tooltip');
        var tootltip = new coreui.Tooltip(tooltipEl);
    </script>

    <script type="text/javascript" src="vendors/@coreui/chartjs/js/coreui-chartjs.bundle.js" class="view-script"></script>
    <script type="text/javascript" src="vendors/@coreui/utils/js/coreui-utils.js" class="view-script"></script>
    <script type="text/javascript" src="js/main.js" class="view-script"></script>
    <div class="c-sidebar-backdrop c-fade c-show"></div>
</body>

</html>