@extends('layout')
@section('content')
    @if(\Route::is('filter_mod'))
        {{--{{dd(['filter_mod' => $game_mode])}}--}}
        {{ Breadcrumbs::render('filter_mod', $game_mode) }}
    @elseif(\Route::is('filter_location'))
        {{ Breadcrumbs::render('filter_location', $location) }}
    @elseif(\Route::is('filter_map'))
        {{ Breadcrumbs::render('filter_map', $map) }}
    @elseif(\Route::is('filter_mod_location'))
        {{ Breadcrumbs::render('filter_mod_location', $game_mode, $location) }}
    @elseif(\Route::is('filter_mod_map'))
        {{ Breadcrumbs::render('filter_mod_map', $game_mode, $map) }}
    @endif
    @include('block.top-servers')
    @if(isset($game_mode) && \Route::is('filter_mod'))
        <div class="info-p mb-5">
            <div class="w-100">
                <img class="mb-5 mw-100" src="{{asset(sprintf('images/mod/%s.jpg', $game_mode->type))}}" alt="Сервера кс го {{$game_mode->name3}}">
            </div>
            {!! $seo_description !!}
        </div>
    @endif
    <h1>Сервера cs go {{$title_h1}}</h1>
    @if($servers->isNotEmpty())
        <table>
            <tr>
                <th style="width: 20px; text-align: center">#</th>
                <th style="width: 500px">Имя</th>
                <th style="width: 185px">Карта</th>
                <th style="width: 75px; text-align: center">Игроки</th>
                <th style="width: 200px; text-align: center">IP:Port</th>
                <th style="width: 120px; text-align: center">Рейтинг</th>
            </tr>
            @foreach($servers as $key=>$server)
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
                    <td>
                        @if(\Route::is('filter_mod'))
                            @if($slug == 'dust2only' && $server->map == 'de_dust2')
                                <a href="{{route('filter_map', $server->map)}}">{{$server->map}}</a>
                            @else
                                <a href="{{route('filter_mod_map', ['slug' => $slug, 'slug2' => $server->map])}}">{{$server->map}}</a>
                            @endif

                        @else
                            <a href="{{route('filter_map', $server->map)}}">{{$server->map}}</a>
                        @endif

                    </td>
                    <td style="text-align: center">{{$server->players}} / {{$server->maxplayers}}</td>
                    <td style="text-align: center">{{$server->ip}}:{{$server->port}}</td>
                    <td style="text-align: center">{{$server->rating}}</td>
                </tr>
                @php($keyID++)
            @endforeach
        </table>
        @include('block.pagination')
    @else
        <h3 class="red">По данному запросу ничего не найдено :(</h3>
    @endif
@endsection
