@extends('layout')
@section('content')
    {{ Breadcrumbs::render('add_server') }}
    <h1 class="text-center">Добавить сервер Counter-Strike: Global Offensive</h1>
    <form action="{{route('add_server_post')}}" method="post" class="d-flex justify-content-center align-items-center">
        @csrf
        <input type="text" name="address" autocomplete="off" placeholder="IP:Port" class="text-center input" required>
        <select name="game_mode" class="ml-5 input">
            <option value="" disabled selected>Мод сервера</option>
            @foreach($game_mode as $mode)
                <option value="{{$mode->type}}">{{$mode->name}}</option>
            @endforeach
        </select>
        <button type="submit" class="ml-5">Добавить</button>
    </form>
    @if($status == 1)
        <div class="add-green">
            <b>Сервер добавлен в мониторинг ;)</b>
            <p class="m-0">Теперь вы можете посмотреть
                <a href="{{route('server_info', $server_address)}}" style="text-decoration: underline; font-weight: 600;">информацию о сервере →</a>
                <br>А также «<a href="{{route('services')}}" style="text-decoration: underline; font-weight: 600;">заказать услуги</a>»
            </p>
        </div>
    @elseif($status == 2)
        <div class="add-red">Что-то пошло не так... Попробуйте позже</div>
    @elseif($status == 3)
        <div class="add-red">
            <p class="m-0">Не удалось получить информацию о сервере!</p>
            <p class="m-0"><b>Попробуйте добавить сервер через 5 минут.</b></p>
        </div>
    @elseif($status == 4)
        <div class="add-red">
            <p class="m-0">Сервер уже есть в мониторинге!</p>
            <p class="m-0">
                <a href="{{route('server_info', $server_adress)}}" style="text-decoration: underline; font-weight: 400;">Информация о сервере →</a>
            </p>
        </div>
    @elseif($status == 5)
        <div class="add-red">Некорректный ip:port или hostname:port</div>
    @elseif($status == 6)
        <div class="add-red">Данный сервер не принадлежит игре Counter-Strike: Global Offensive!</div>
    @else
        <div class="add-red" style="background: #f2f2f2;">Чтобы <strong>добавить сервер в мониторинг</strong>, вам нужно вставить айпи адрес и порт сервера кс го. А также указать режим мода сервера, чтобы игрокам было легче найти в поисковиках. После добавления сервера, можно <a href="{{route('services')}}" class="green" title="Услуги для сервера кс го">заказать услуги</a> для быстрой раскрутки сервера.</div>
        <h2 class="mt-15">25 новых серверов по cs go</h2>
        @include('block.server_list')
    @endif
@endsection
