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


@yield('content')


@include('admin.includes.js')
@stack('js')
</body>


</html>
