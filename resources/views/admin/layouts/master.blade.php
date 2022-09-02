<!DOCTYPE html>
<html lang="en" class="material-style layout-fixed">
<head>
    <title>Inventory Management</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <link rel="icon" type="image/x-icon" href="{{ asset('back-end/assets/img/favicon.ico') }}" />

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet" />
    @include('admin.includes.css')
    @stack('css')
</head>
<body>
<div class="page-loader">
    <div class="bg-primary"></div>
</div>

<div class="layout-wrapper layout-2">
    <div class="layout-inner">
        <!--Sidebar start-->
        <div id="layout-sidenav" class="layout-sidenav sidenav sidenav-vertical bg-white logo-dark">
            @include('admin.includes.sideBar')
        </div>
        <!--Sidebar end-->
        <div class="layout-container">
            <!--Start nav-->
            @include('admin.includes.nav')
            <!--End nav-->

            <div class="layout-content">
                <div class="container-fluid flex-grow-1 container-p-y">
                    <h4 class="font-weight-bold py-3 mb-0">Dashboard</h4>
                    <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#"><i class="feather icon-home"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">@yield('title')</a></li>
                            <li class="breadcrumb-item active">@yield('page_title')</li>
                        </ol>
                    </div>
                    @yield('content')
                </div>

                <!--Footer start-->
                @include('admin.includes.footer')
                <!--Footer End-->
            </div>
        </div>
    </div>

    <div class="layout-overlay layout-sidenav-toggle"></div>
</div>
<!--Logout start-->
    @include('admin.includes.logout')
<!--Logout end-->

@include('admin.includes.js')
@include('admin.includes.commonjs')
@stack('js')
</body>
</html>
