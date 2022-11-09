@extends('admin.layout')
@section('title', 'Админ - Информация о сервере - '.$server->name)
@section('admin.content')
    <div class="content-header">
        <div class="bredcr">
            <h1>Информация о сервере - {{$server->name}}</h1>
        </div>
    </div>
    <div class="card">
        <div class="d-flex btn-content">
            <a class="btn b-blue" href="{{route('admin.servers.edit', $server->id)}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Ред.</a>
            <a class="btn b-red" href="{{route('admin.servers.destroy', $server->id)}}"><i class="fa fa-trash-o" aria-hidden="true"></i> Удалить</a>
        </div>
        <div class="card-body padding-l-r-10 infoserver d-flex">
            <div class="mapserver">
                @if(is_file(sprintf('images/maps/%s.jpg', $server->map)))
                    <img src="{{asset(sprintf('images/maps/%s.jpg', $server->map))}}" class="mw-100" alt="Карта {{$server->map}}">
                @else
                    <img src="{{asset('images/maps/no_image.jpg')}}" class="mw-100" alt="Карта {{$server->map}}">
                @endif
            </div>
            <div class="descserver">
                <div class="d-flex info-table-item">
                    <p><b>ID:</b></p>
                    <p>{{$server->id}}</p>
                </div>
                <div class="d-flex info-table-item">
                    <p><b>Имя:</b></p>
                    <p>{{$server->name}}</p>
                </div>
                <div class="d-flex info-table-item">
                    <p><b>Карта:</b></p>
                    <p>{{$server->map}}</p>
                </div>
                <div class="d-flex info-table-item">
                    <p><b>Игра:</b></p>
                    <p>{{$server->game}}</p>
                </div>
                <div class="d-flex info-table-item">
                    <p><b>Игроки:</b></p>
                    <p>{{sprintf('%s/%s (%s)', $server->players, $server->maxplayers, $server->bots)}}</p>
                </div>
                <div class="d-flex info-table-item">
                    <p><b>OS:</b></p>
                    <p><i class="fa {{$server->os == 'l' ? 'fa-linux' : 'fa-windows'}}" aria-hidden="true"></i></p>
                </div>
                <div class="d-flex info-table-item">
                    <p><b>Версия:</b></p>
                    <p>{{$server->version}}</p>
                </div>
                <div class="d-flex info-table-item">
                    <p><b>Адрес:</b></p>
                    <p>{{sprintf('%s:%s (%s)', $server->ip, $server->port, $server->specport)}}</p>
                </div>
                <div class="d-flex info-table-item">
                    <p><b>Пароль:</b></p>
                    <p>{{$server->password == 1 ? 'Да' : 'Нет'}}</p>
                </div>
                <div class="d-flex info-table-item">
                    <p><b>Мод:</b></p>
                    <p>{{sprintf('%s (%s)', $server->game_mode->name, $server->mode)}}</p>
                </div>
                <div class="d-flex info-table-item">
                    <p><b>Страна:</b></p>
                    <p>{{sprintf('%s (%s)', $server->location->location_name, $server->country)}}</p>
                </div>
                <div class="d-flex info-table-item">
                    <p><b>Сервер добавлен:</b></p>
                    <p>{{\Carbon\Carbon::createFromTimestamp($server->created_at)->format('d.m.Y в h:i:s')}}</p>
                </div>
                <div class="d-flex info-table-item">
                    <p><b>Последнее обновление:</b></p>
                    <p>{{\Carbon\Carbon::createFromTimestamp($server->updated_at)->format('d.m.Y в h:i:s')}}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
