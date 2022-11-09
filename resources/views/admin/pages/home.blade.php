@extends('admin.layout')
@section('title', 'Админ - Главная')
@section('admin.content')
    <div class="content-header">
        <div class="bredcr">
            <h1>Главная</h1>
        </div>
    </div>
    <div class="d-flex">
        <div class="card card-secondary w-40 mr-15">
            <div class="card-header">
                <h3 class="card-title">Данные системы</h3>
            </div>
            <div class="card-body padding-l-r-10">
                <div class="d-flex info-table-item">
                    <p><b>Всего в БД:</b></p>
                    <p>670	серверов</p>
                </div>
                <div class="d-flex info-table-item">
                    <p><b>В данный момент работают:</b></p>
                    <p>557 серверов</p>
                </div>
                <div class="d-flex info-table-item">
                    <p><b>Администраторов в БД:</b></p>
                    <p>1 человек</p>
                </div>
                <div class="d-flex info-table-item">
                    <p><b>Новостей в БД:</b></p>
                    <p>6 новостей</p>
                </div>
                <div class="d-flex info-table-item">
                    <p><b>Оборот денег за месяц:</b></p>
                    <p>200 рублей</p>
                </div>
            </div>
        </div>
        <div class="card card-secondary w-40 mr-15">
            <div class="card-header">
                <h3 class="card-title">Информация о сервере</h3>
            </div>
            <div class="card-body padding-l-r-10">
                <div class="d-flex info-table-item">
                    <p><b>Операционная система:</b></p>
                    <p>{{$variables['version_os']}} <i class="fa {{$variables['version_os'] == 'Linux' ? 'fa-linux' : 'fa-windows'}}" aria-hidden="true"></i></p>
                </div>
                <div class="d-flex info-table-item">
                    <p><b>Версия php:</b></p>
                    <p>{{phpversion()}}</p>
                </div>
                <div class="d-flex info-table-item">
                    <p><b>Версия MySQL:</b></p>
                    <p>{{collect($variables['version_mysql'])->first()->version}}</p>
                </div>
                <div class="d-flex info-table-item">
                    <p><b>Размер БД MySQL:</b></p>
                    <p>{{sprintf('%sмб, %sкб', $variables['size_db'][0], $variables['size_db'][1])}}</p>
                </div>
                <div class="d-flex info-table-item">
                    <p><b>Время на сервере:</b></p>
                    <p>{{$variables['data_srv']}}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
