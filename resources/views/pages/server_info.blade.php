@extends('layout')
@section('content')
    {{ Breadcrumbs::render('server_info', $server->name) }}
    <h1>{{$server->name}}</h1>
    <div class="server-content">
        <div class="server-map">
            <div class="map-img w-300 mb-5">
                @if(is_file(sprintf('images/maps/%s.jpg', $server->map)))
                    <img src="{{asset(sprintf('images/maps/%s.jpg', $server->map))}}" class="mw-100" alt="Карта {{$server->map}}">
                @else
                    <img src="{{asset('images/maps/default.jpg')}}" class="mw-100" alt="Карта {{$server->map}}">
                @endif
            </div>
            <a href="steam://connect/{{$server->ip}}:{{$server->port}}" class="green"><b>🎮 Подключиться через Steam</b></a>
        </div>
        <div class="server-info d-flex flex-wrap">
            <div class="w-300">
                <p><b>Статус сервера:</b> <b class="green">✓ Онлайн</b></p>
                <p><b>IP сервера:</b> <a href="#" title="Скопировать ip:port сервера" class="ip-port" onclick="copyClick(event, '{{$server->ip}}:{{$server->port}}')">{{$server->ip}}:{{$server->port}}</a></p>
                <p><b>Текущая карта:</b> <a href="{{route('filter_map', $server->map)}}" title="Мониторинг серверов кс го {{$server->map}}">{{$server->map}}</a></p>
                @php $game_mode = $server->game_mode; @endphp
                {{--@if(isset($_COOKIE['debug_player']))
                    {{dd($game_mode)}}
                @endif--}}
                <p><b>Мод игры:</b> <a href="{{route('filter_mod', $game_mode->type)}}" title="Сервера cs go {{$game_mode->type}}">{{$game_mode->name}}</a></p>
                <p><b>Игроки:</b> {{$server->players}} / {{$server->maxplayers}}</p>
                <p><b>Рейтинг сервера:</b> {{$server->rating}}</p>
                <p class="m-0"><b>Глобальный ранг:</b> 0</p>
            </div>
            <div class="w-300">
                <p><b>Игра:</b> CS:GO</p>
                @php $country = $server->location; @endphp
                <p>
                    <b>Страна:</b>
                    @if(is_file(sprintf('images/flags/%s.png', $country->first()->code)))
                        <img src="{{asset(sprintf('images/flags/%s.png', $country->first()->code))}}" class="mw-100 w16h16" style="margin-top: -7px;" alt="Страна {{$country->first()->location_name}}">
                    @else
                        <img src="{{asset('images/flags/OFF.png')}}" class="mw-100 w16h16" style="margin-top: -7px;" alt="Страна OFF">
                    @endif
                    <a href="{{route('filter_location', $country->first()->code)}}" title="Сервера с локацией {{$country->first()->location_name}} ({{$country->first()->code}})">
                        <span>{{$country->first()->location_name}} ({{$country->first()->code}})</span>
                    </a>
                </p>
                <p><b>Версия:</b> {{$server->version}}</p>
                <p><b>ОС сервера:</b> {{$server->os == 'l' ? 'Linux' : 'Windows'}}</p>
                <p><b>Добавлен в систему:</b> {{Carbon\Carbon::parse($server->created_at)->format('d-m-Y в H:i:s')}}</p>
                <p><b>Обновлен:</b> {{Carbon\Carbon::parse($server->updated_at)->format('d-m-Y в H:i:s')}}</p>
                <p><b>Поделиться:</b> <a href="#" title="Скопировать url сервера" class="link-server" onclick="copyClick(event, '123')">Копировать ссылку</a></p>
            </div>
        </div>

        <div class="players-list">
            <h2>Игроки онлайн:</h2>
            @if(!is_null($server->players_list))
                <table class="w-300" style="border: 1px solid black;">
                    <tr>
                        <th>Имя</th>
                        <th class="text-center">Фраги</th>
                    </tr>
                    @foreach($server->players_list as $key=>$player)
                        <tr>
                            <td>{{$player['Name']}}</td>
                            <td class="text-center">{{$player['Frags']}}</td>
                        </tr>
                    @endforeach
                </table>
            @else
                <p>Игроков нет на сервере :(</p>
            @endif
        </div>
    </div>
    <script>
        function copyClick(e, text) {
            e.preventDefault();
            if(e.target.className === 'ip-port'){
                e.target.innerHTML = '<b class="green">✓ IP:Port скопирован.</b>';
            }else{
                e.target.innerHTML = '<b class="green">✓ Ссылка скопирована.</b>';
            }
            var dummy = document.createElement("textarea");
            document.body.appendChild(dummy);
            dummy.value = text;
            dummy.select();
            document.execCommand("copy");
            document.body.removeChild(dummy);
        }
    </script>
@endsection
