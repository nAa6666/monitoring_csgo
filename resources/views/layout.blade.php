<!DOCTYPE html>
<html lang="ru" prefix="og: http://ogp.me/ns#">
<head>
    <meta charset="utf-8">
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
    <meta property="og:locale" content="ru_RU">
    <meta name="theme-color" content="#dddddd">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    @if(!empty(request()->input('page')))
        <meta name="robots" content="noindex, nofollow">
    @else
        <meta name="robots" content="index, follow">
    @endif
    <meta name="webmoney" content="7BF37CC3-9E70-41C0-B115-02742BC01BB3"/>
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('images/favicon/180x180.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/favicon/32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/favicon/16x16.png')}}">
    <link rel="manifest" href="{{asset('manifest.json')}}">
    <link rel="alternate" hreflang="ru" href="{{url()->current()}}">
    <link rel="shortcut icon" href="{{asset('images/favicon.ico')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{mix('styles/compiled/style.min.css')}}" type="text/css" media="all">
</head>
<body>
    @include('header')
    <section class="main">
        <div class="container-fluid">
            @yield('content')
        </div>
    </section>
    @include('footer')
</body>
</html>
