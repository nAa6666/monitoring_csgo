@extends('layout')
@section('content')
    @include('block.top-servers')

    <h1>Мониторинг серверов CS:GO</h1>
    <table>
        <tr class="d-flex">
            <th class="tb_number text-center">#</th>
            <th class="tb_name">Имя</th>
            @if(!$agent->isMobile())
                <th class="tb_map">Карта</th>
                <th class="tb_players text-center">Игроки</th>
                <th class="tb_address text-center">IP:Port</th>
                <th class="tb_rate text-center">Рейтинг</th>
            @endif
        </tr>
        @foreach($servers as $key=>$server)
            <tr class="d-flex">
                @if($key < 3)
                    <td class="green text-center tb_number">★</td>
                    <td class="tb_name"><b><a href="{{route('server_info', ['slug' => $server->ip.':'.$server->port])}}">{{$server->name}}</a></b></td>
                @else
                    <td class="text-center tb_number">{{$key+1}}</td>
                    <td class="tb_name"><a href="{{route('server_info', ['slug' => $server->ip.':'.$server->port])}}">{{$server->name}}</a></td>
                @endif
                @if(!$agent->isMobile())
                    <td class="tb_map"><a href="{{route('filter_map', $server->map)}}">{{$server->map}}</a></td>
                    <td class="tb_players text-center">{{$server->players}} / {{$server->maxplayers}}</td>
                    <td class="tb_address text-center">{{$server->ip}}:{{$server->port}}</td>
                    <td class="tb_rate text-center">{{$server->rating}}</td>
                @endif
            </tr>
        @endforeach
    </table>
    <p class="mt-15 text-center"><a href="{{route('servers')}}">Весь список серверов →</a></p>
@endsection
