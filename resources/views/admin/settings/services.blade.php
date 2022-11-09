@extends('admin.layout')
@section('title', 'Админ - Услуги')
@section('admin.content')
    <div class="content-header">
        <div class="bredcr">
            <h1>Услуги</h1>
        </div>
    </div>
    <div id="services" class="card" style="max-width: 490px">
        <div class="card-body table-responsive">
            <form action="">
                @csrf
                <table class="table table-hover text-nowrap">
                    <tbody>
                        <tr>
                            <td width="25%">Имя услуги</td>
                            <td class="text-center" width="25%">Цена</td>
                            <td class="text-center" width="25%">Кол-во мест</td>
                            <td class="text-center" width="25%">Кол-во дней</td>
                        </tr>
                        <tr>
                            <td width="25%"><b>Vip</b></td>
                            <td width="25%">
                                <input type="text" name="vip_price" class="formAdm m-0">
                            </td>
                            <td width="25%">
                                <input type="text" name="vip_amount" class="formAdm m-0">
                            </td>
                            <td width="25%">
                                <input type="text" name="vip_days" class="formAdm m-0">
                            </td>
                        </tr>
                        <tr>
                            <td width="25%"><b>Top</b></td>
                            <td width="25%">
                                <input type="text" name="vip_price" class="formAdm m-0">
                            </td>
                            <td width="25%">
                                <input type="text" name="vip_amount" class="formAdm m-0">
                            </td>
                            <td width="25%">
                                <input type="text" name="vip_days" class="formAdm m-0">
                            </td>
                        </tr>
                        <tr>
                            <td width="25%"><b>Рейтинг</b></td>
                            <td width="25%">
                                <input type="text" name="vip_price" class="formAdm m-0">
                            </td>
                            <td width="25%">
                                <input type="text" name="vip_amount" class="formAdm m-0">
                            </td>
                            <td width="25%">
                                <input type="text" name="vip_days" class="formAdm m-0">
                            </td>
                        </tr>
                        <tr>
                            <td width="25%"><b>Выделить</b></td>
                            <td width="25%">
                                <input type="text" name="vip_price" class="formAdm m-0">
                            </td>
                            <td width="25%">
                                <input type="text" name="vip_amount" class="formAdm m-0">
                            </td>
                            <td width="25%">
                                <input type="text" name="vip_days" class="formAdm m-0">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
    <button class="btn b-blue" type="submit">Сохранить</button>
@endsection
