<!DOCTYPE html>
<html lang="ru" prefix="og: http://ogp.me/ns#">
<head>
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta charset="utf-8">
    <meta property="og:locale" content="ru_RU">
    <meta name="theme-color" content="#dddddd">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="shortcut icon" href="{{asset('images/favicon.ico')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{mix('styles/compiled/admin/style.min.css')}}" type="text/css" media="all">
</head>
<body>
    <div class="wrapper">
        @include('admin.header')
        <div class="content-wrapper">
            @yield('admin.content')
        </div>
        @include('admin.footer')
    </div>
    @stack('scripts')
</body>
</html>
