@extends('layout')
@section('content')
    {{ Breadcrumbs::render('sitemap') }}
    <h1>Карта сайта</h1>
    <ul class="w-100 d-flex flex-wrap">
        <li class="mr-15"><a href="{{route('add_server')}}" title="Добавить сервер кс го в мониторинг">Добавить сервер</a></li>
        <li class="mr-15"><a href="{{route('services')}}" title="Услуги для раскрутки кс го">Услуги</a></li>
        <li class="mr-15"><a href="{{route('podobrat_server')}}" title="Фильтр по подбору">Подобрать сервер</a></li>
        <li class="mr-15"><a href="{{route('faq')}}" title="FAQ Вопросы/ответы">FAQ</a></li>
        <li class="mr-15"><a href="{{route('contacts')}}" title="Написать нам">Обратная связь</a></li>
        <li class="mr-15"><a href="{{route('servers')}}" title="Сервер-лист мониторинга">Весь список серверов</a></li>
    </ul>
    <h2 class="mt-15">Моды по КС ГО</h2>
    <ul class="w-100 d-flex flex-wrap">
        @foreach($game_mode as $mod)
            <li class="mr-15"><a href="{{route('filter_mod', $mod->type)}}" title="Сервера cs go {{$mod->type}}">{{$mod->name}}</a></li>
        @endforeach
    </ul>
    <h3 class="mt-15">Страны по КС ГО</h3>
    <ul class="w-100 d-flex flex-wrap">
        @foreach($location_server as $location)
            <li class="mr-15"><a href="{{route('filter_location', $location->code)}}" title="Сервера кс го с локацией {{$location->location_name}}">{{$location->location_name}}</a></li>
        @endforeach
    </ul>
@endsection
