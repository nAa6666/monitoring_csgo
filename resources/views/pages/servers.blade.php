@extends('layout')
@section('content')
    {{ Breadcrumbs::render('servers') }}
    <h1>Список серверов по КС ГО</h1>
    <table>
        <tr>
            <th style="width: 30px; text-align: center">#</th>
            <th style="width: 500px">Имя</th>
            <th style="width: 185px">Карта</th>
            <th style="width: 75px; text-align: center">Игроки</th>
            <th style="width: 200px; text-align: center">IP:Port</th>
            <th style="width: 120px; text-align: center">Рейтинг</th>
        </tr>
        @foreach($servers->items() as $key=>$server)
            <tr>
                @if($keyID < 3)
                    <td class="green text-center">★</td>
                    <td>
                        <b>
                            <a href="{{route('server_info', ['slug' => $server->ip.':'.$server->port])}}">
                                {{Str::limit($server->name, $limit = 70, $end = '...')}}
                            </a>
                        </b>
                    </td>
                @else
                    <td class="text-center">{{$keyID+1}}</td>
                    <td>
                        <a href="{{route('server_info', ['slug' => $server->ip.':'.$server->port])}}">
                            {{Str::limit($server->name, $limit = 70, $end = '...')}}
                        </a>
                    </td>
                @endif
                <td><a href="{{route('filter_map', $server->map)}}">{{$server->map}}</a></td>
                <td class="text-center">{{$server->players}} / {{$server->maxplayers}}</td>
                <td class="text-center">{{$server->ip}}:{{$server->port}}</td>
                <td class="text-center">{{$server->rating}}</td>
            </tr>
            @php($keyID++)
        @endforeach
    </table>
    @include('block.pagination')
@endsection
