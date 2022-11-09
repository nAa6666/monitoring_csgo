<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Авторизация</title>
    <link rel="stylesheet" href="{{ asset('css2') }}">
</head>
<body>
<div id="login">
    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div id="login-box" class="col-md-12">
                    <form id="login-form" class="form" action="{{ route('admin.login') }}" method="POST">
                        @if($errors->any())
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger d-flex align-items-center" role="alert">
                                    <svg class="bi bi-x-octagon mr-3" xmlns="http://www.w3.org/2000/svg" width="24"
                                         height="24" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>
                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                    </svg>
                                    <span style="font-weight: bold;">{{ $error }}</span>
                                </div>
                            @endforeach
                        @endif
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="inputEmail" class="sr-only text-info">Email</label>
                            <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email" required autofocus>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword" class="sr-only text-info">Пароль</label>
                            <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Пароль" required>
                        </div>
                        <div class="form-group mt-4">
                            <button class="btn btn-lg btn-info float-right" type="submit" name="submit">Войти</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
