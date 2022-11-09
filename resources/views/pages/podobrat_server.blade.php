@extends('layout')
@section('content')
    {{ Breadcrumbs::render('podobrat_server') }}
    <h1>Подобрать сервер Counter-Strike: Global Offensive</h1>
    <h2>По моду:</h2>
    <div class="d-flex flex-wrap">
        @foreach($game_mode as $mod)
            <a href="{{route('filter_mod', $mod->type)}}" class="btn-mod mr-15 mb-5" title="{{$mod->name2}} кс го сервера">{{$mod->name}}</a>
        @endforeach
    </div>
    <h2>По стране/локации:</h2>
    <div class="d-flex flex-wrap">
        @foreach($location_server as $location)
            <a href="{{route('filter_location', $location->code)}}" class="btn-mod mr-15 mb-5" title="сервера с локацией {{$location->location_name}} кс го">
                @if(is_file(sprintf('images/flags/%s.png', $location->code)))
                    <img src="{{asset(sprintf('images/flags/%s.png', $location->code))}}" class="mw-100 w16h16" style="margin-top: -3px;" alt="Страна {{$location->location_name}}">
                @else
                    <img src="{{asset('images/flags/OFF.png')}}" class="mw-100 w16h16" style="margin-top: -3px;" alt="Страна OFF">
                @endif
                {{$location->location_name}} ({{$location->code}})
            </a>
        @endforeach
    </div>
    <h3>Популярные карты:</h3>
    <div class="d-flex flex-wrap">
        <a href="{{route('filter_map', 'de_dust2')}}" class="btn-mod mr-15 mb-5" title="сервера кс го de_dust2">de_dust2</a>
    </div>
@endsection
