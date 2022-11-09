@extends('admin.layout')
@section('title', 'Админ - Добавить сервер')
@section('admin.content')
    <div class="content-header">
        <div class="bredcr">
            <h1>Добавить сервер</h1>
        </div>
    </div>
    <div class="">
        <form action="{{route('admin.servers.store')}}" method="post" class="d-flex add_server">
            @csrf
            <input type="text" name="adress" autocomplete="off" placeholder="IP:Port" class="text-center formAdm" required>
            <select name="game_mode" class="ml-5 formAdm">
                <option value="" disabled selected>Мод сервера</option>12312312321321
                @foreach($game_mode as $mode)
                    <option value="{{$mode->type}}">{{$mode->name}}</option>
                @endforeach
            </select>
            <button type="submit" class="ml-5 btn b-blue">Добавить</button>
        </form>
        @if(isset($status))
            @if($status == 0)
                <div class="add-green">
                    <b>Сервер добавлен в мониторинг ;)</b>
                    <p class="m-0">
                        <a href="{{route('admin.servers.show', $serverCheck->id)}}" style="text-decoration: underline; font-weight: 400;">Информация о сервере →</a>
                    </p>
                </div>
            @elseif($status == 1)
                <div class="add-red">
                    <p class="m-0">Сервер уже есть в мониторинге!</p>
                    <p class="m-0">
                        <a href="{{route('admin.servers.show', $serverCheck->id)}}" style="text-decoration: underline; font-weight: 400;">Информация о сервере →</a>
                    </p>
                </div>
            @else
                <div class="add-red">
                    <p class="m-0">Сервер выключен! :(</p>
                </div>
            @endif
        @endif
    </div>
@endsection
