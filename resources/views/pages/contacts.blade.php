@extends('layout')
@section('content')
    {{ Breadcrumbs::render('contacts') }}
    <h1>Обратная связь</h1>
    <form id="form" action="{{route('contacts_post')}}" method="post" class="d-flex w-300 flex-wrap" onsubmit="return validateForm()">
        @csrf
        <input type="text" name="name" placeholder="Имя" class="mb-5 w-100 input" required>
        <input type="email" name="email" placeholder="E-mail" class="mb-5 w-100 input" required>
        <textarea rows="10" cols="45" name="comment" class="mb-5 w-100 input" style="resize: none;" required></textarea>
        <div id="grecaptcha" class="mb-5"></div>
        <button type="submit">Отправить</button>
    </form>
    @include('block.grecaptcha')
@endsection
