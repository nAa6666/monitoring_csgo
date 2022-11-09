<nav class="main-header">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link{{Route::is('admin.home') ? ' active' : ''}}" href="{{route('admin.home')}}"><i class="fa fa-home" aria-hidden="true"></i> Главная</a>
        </li>
        <li class="nav-item">
            <a class="nav-link{{Route::is('admin.servers.index') ? ' active' : ''}}" href="{{route('admin.servers.index')}}"><i class="fa fa-server" aria-hidden="true"></i> Сервера</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.news.create')}}"><i class="fa fa-plus" aria-hidden="true"></i> Добавить новости</a>
        </li>
    </ul>

    <form class="form--search" action="{{route('admin.search')}}" method="post">
        @csrf
        <input type="text" name="q" autocomplete="off" placeholder="Имя или IP:Port" required>
        <button><i class="fa fa-search" aria-hidden="true"></i></button>
    </form>
</nav>
<aside class="main-sidebar">
    <a href="{{route('admin.home')}}" class="brand-link">
        <span class="brand-text font-weight-light">Admin Panel</span>
    </a>
    <div class="sidebar">
        <nav>
            <ul class="nav">
                <li class="nav-header"><i class="fa fa-server" aria-hidden="true"></i> Сервера</li>
                <li class="nav-item">
                    <a href="{{route('admin.servers.create')}}" class="nav-link{{Route::is('admin.servers.create') ? ' active' : ''}}"><i class="fa fa-plus icn14" aria-hidden="true"></i> Добавить</a>
                    <a href="{{route('admin.servers.index')}}" class="nav-link{{Route::is('admin.servers.index') ? ' active' : ''}}"><i class="fa fa-tasks" aria-hidden="true"></i> Все сервера</a>
                    <a href="{{route('admin.servers.new')}}" class="nav-link {{Route::is('admin.servers.new') ? ' active' : ''}}"><i class="fa fa-plug" aria-hidden="true"></i> Новые сервера</a>
                    <a href="#" class="nav-link"><i class="fa fa-pie-chart" aria-hidden="true"></i> История Серверов</a>
                </li>
                <li class="nav-header"><i class="fa fa-bullhorn" aria-hidden="true"></i> Новости</li>
                <li class="nav-item">
                    <a href="{{route('admin.news.create')}}" class="nav-link{{Route::is('admin.news.create') ? ' active' : ''}}"><i class="fa fa-plus icn14" aria-hidden="true"></i> Добавить</a>
                    <a href="{{route('admin.news.index')}}" class="nav-link{{Route::is('admin.news.index') ? ' active' : ''}}"><i class="fa fa-comments" aria-hidden="true"></i> Все новости</a>
                </li>
                <li class="nav-header"><i class="fa fa-newspaper-o" aria-hidden="true"></i> Биллинг</li>
                <li class="nav-item">
                    <a href="{{route('admin.payment')}}" class="nav-link"><i class="fa fa-university" aria-hidden="true"></i> Оплата</a>
                    <a href="{{route('admin.services')}}" class="nav-link {{Route::is('admin.services') ? ' active' : ''}}"><i class="fa fa-rub icn14" aria-hidden="true"></i> Услуги</a>
                    <a href="#" class="nav-link"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Транзакции</a>
                </li>
                <li class="nav-header"><i class="fa fa-cogs" aria-hidden="true"></i> Настройки</li>
                <li class="nav-item">
                    <a href="#" class="nav-link"><i class="fa fa-wrench" aria-hidden="true"></i> Общие</a>
                    <a href="#" class="nav-link"><i class="fa fa-envelope-o" aria-hidden="true"></i> E-mail</a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
