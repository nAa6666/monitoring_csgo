<footer>
    <div class="container-fluid">
        <div class="d-flex justify-content-between">
            <div class="info-sys">
                {{--@if(!is_null(Api::getStatsFooter()))
                    <p>Серверов в бд: {{Api::getStatsFooter()->servers_count}}</p>
                    <p>Cервера онлайн: {{Api::getStatsFooter()->servers_online_count}}</p>
                    <p>Занято слотов: {{Api::getStatsFooter()->used_slots}}</p>
                    <p>Всего слотов: {{Api::getStatsFooter()->all_slots}}</p>
                    <a href="{{route('sitemap')}}">Карта сайта</a>
                @endif--}}
            </div>
            <div class="info-link">
                <ul>
                    <li><a href="{{route('add_server')}}">Добавить сервер</a></li>
                    <li><a href="{{route('podobrat_server')}}">Подобрать сервер</a></li>
                    <li><a href="{{route('faq')}}">FAQ</a></li>
                    <li><a href="{{route('contacts')}}">Обратная связь</a></li>
                </ul>
            </div>
        </div>
        <p class="text-center mt-25">Copyright © 2020 CSGO-MS.com</p>
    </div>
</footer>
