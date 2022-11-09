<nav class="menu container-fluid d-flex justify-content-between">
    <ul class="m-ul d-flex align-items-center">
        <li><a href="{{route('home')}}">CSGO-MS.com</a></li>
        <li><a href="{{route('add_server')}}" class="green">Добавить сервер</a></li>
        <li><a href="{{route('services')}}">Услуги</a></li>
        <li><a href="{{route('podobrat_server')}}" class="grey">Подобрать сервер</a></li>
        <li><a href="{{route('contacts')}}">Обратная связь</a></li>
    </ul>
    <div class="search-head">
        <form action="{{route('search')}}" method="get">
            <input class="input" type="text" name="q" autocomplete="off" placeholder="IP:Port" required>
            <button type="submit">Искать</button>
        </form>
    </div>
</nav>
