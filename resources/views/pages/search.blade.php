@extends('layout')
@section('content')
    {{ Breadcrumbs::render('search') }}
    @include('block.top-servers')
    <h1>Поиск по запросу: {{$search_ip_port}}</h1>
    @if(!is_null($server))
        <table>
            <tr>
                <th style="width: 20px; text-align: center">#</th>
                <th style="width: 500px">Имя</th>
                <th style="width: 185px">Карта</th>
                <th style="width: 75px; text-align: center">Игроки</th>
                <th style="width: 200px; text-align: center">IP:Port</th>
                <th style="width: 120px; text-align: center">Рейтинг</th>
            </tr>
            <tr>
                <td class="text-center">1</td>
                <td><a href="{{route('server_info', ['slug' => $server->ip.':'.$server->port])}}">{{Str::limit($server->name, $limit = 70, $end = '...')}}</a></td>
                <td><a href="{{route('filter_map', $server->map)}}">{{$server->map}}</a></td>
                <td style="text-align: center">{{$server->players}} / {{$server->maxplayers}}</td>
                <td style="text-align: center">{{$server->ip}}:{{$server->port}}</td>
                <td style="text-align: center">{{$server->rating}}</td>
            </tr>
        </table>
    @else
        <h3 class="red">По данному запросу ничего не найдено :(</h3>
    @endif
@endsection
