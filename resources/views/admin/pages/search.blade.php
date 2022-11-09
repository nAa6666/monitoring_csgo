@extends('admin.layout')
@section('title', 'Админ - Список серверов')
@section('admin.content')
    <div class="content-header">
        <div class="bredcr">
            <h1>Результат по поиску - {{$slug}}</h1>
        </div>
    </div>
    <div class="card">
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <tbody>
                <tr>
                    <td class="text-center" width="5%">ID</td>
                    <td width="25%">Имя</td>
                    <td class="text-center" width="5%">Статус</td>
                    <td width="25%">IP:Port</td>
                    <td width="15%">Добавлен</td>
                    <td class="text-center" width="25%">Действия</td>
                </tr>
                @foreach($servers as $key=>$server)
                    <tr>
                        <td width="5%" class="text-center">{{$key+1}}</td>
                        <td width="25%">
                            <a class="tt-line" href="{{route('servers.show', $server->id)}}">
                                <p>{{$server->name}}</p>
                            </a>
                        </td>
                        <td width="5%"><div class="status-{{$server->status == 'Online' ? 'online' : 'offline'}}"></div></td>
                        <td width="25%">{{sprintf('%s:%s', $server->ip, $server->port)}}</td>
                        <td width="15%">{{\Carbon\Carbon::createFromTimestamp($server->created_at)->format('d.m.Y в h:i:s')}}</td>
                        <td width="25%" class="text-center">
                            <a class="btn b-blue" href="{{route('servers.edit', $server->id)}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Ред.</a>
                            <a class="btn b-red" href="{{route('servers.destroy', $server->id)}}"><i class="fa fa-trash-o" aria-hidden="true"></i> Удалить</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
