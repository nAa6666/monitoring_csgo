@extends('admin.layout')
@section('title', 'Админ - Оплата')
@section('admin.content')
    <div class="content-header">
        <div class="bredcr">
            <h1>Оплата</h1>
        </div>
    </div>
    <form action="">
        @csrf
        <div id="payment" class="card">
            <div class="card-body">
                <div class="block-pay">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3>PayPal</h3>
                        <label class="switch">
                            <input type="checkbox" name="paypal_status">
                            <span class="slider"></span>
                        </label>
                    </div>
                    <p>Ключ авторизации</p>
                    <input type="text" class="formAdm">
                    <p>Токен</p>
                    <input type="text" class="formAdm">
                </div>
                <div class="block-pay">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3>WebMoney</h3>
                        <label class="switch">
                            <input type="checkbox" name="webmoney_status">
                            <span class="slider"></span>
                        </label>
                    </div>
                    <p>Ключ авторизации</p>
                    <input type="text" class="formAdm">
                    <p>Токен</p>
                    <input type="text" class="formAdm">
                </div>
                <div class="block-pay">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3>PrivatBank24</h3>
                        <label class="switch">
                            <input type="checkbox" name="privatbank24_status">
                            <span class="slider"></span>
                        </label>
                    </div>
                    <p>Ключ авторизации</p>
                    <input type="text" class="formAdm">
                    <p>Токен</p>
                    <input type="text" class="formAdm">
                </div>
            </div>
        </div>
        <button class="btn b-blue" type="submit">Сохранить</button>
    </form>
@endsection
