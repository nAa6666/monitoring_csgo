@extends('layout')
@section('content')
    {{ Breadcrumbs::render('services') }}
    <h1>Услуги раскрутки</h1>
    @if(isset($_COOKIE['debug_csgoms1']))
        @if($status == 1)
            <div class="add-red">Некорректный ip:port или hostname:port</div>
        @elseif($status == 2)
            <div class="add-red">Сервер не найден в мониторинге!<br>«<a href="{{route('add_server')}}" style="text-decoration: underline; font-weight: 600;">Добавьте сервер в мониторинг</a>», после чего повторите приобретение услуг.</div>
        @else
            <div class="info-p">
                <p class="m-0">Lorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной "рыбой" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн. Его популяризации в новое время послужили публикация листов Letraset с образцами Lorem Ipsum в 60-х годах и, в более недавнее время, программы электронной вёрстки типа Aldus PageMaker, в шаблонах которых используется Lorem Ipsum.</p>
            </div>
        @endif
    @endif
    <div class="d-flex flex-wrap justify-content-center">
        <div class="info-p w-300 mt-15 mr-15">
            <h3 class="m-0">ТОП</h3>
            <form action="{{route('services_check')}}" method="post" class="m-0">
                @csrf
                <input type="hidden" name="services_form" value="top">
                <p class="m-0">Адрес сервера:</p>
                <input type="text" name="server" placeholder="IP:Port" class="mb-5" required>
                <p class="m-0">Цена/Срок:</p>
                <select name="services_id" class="mb-5" required>
                    @foreach($services['top'] as $service_top)
                        <option value="{{$service_top['services_id']}}">{{$service_top['name_services']}}</option>
                    @endforeach
                </select>
                <p class="m-0">Метод оплаты:</p>
                <select name="pay_type" class="mb-5" required>
                    <option value="wb">WebMoney (Merchant)</option>
                    <option value="fk">VISA/QIWI/Yandex и т.д... (Free-Kassa)</option>
                </select>
                <br>
                <button type="submit" class="mb-5">Оплатить</button>
            </form>
        </div>
        <div class="info-p w-300 mt-15 mr-15">
            <h3 class="m-0">VIP/Рейтинг/Баллы</h3>
            <form action="{{route('services_check')}}" method="post" class="m-0">
                @csrf
                <input type="hidden" name="services_form" value="vip">
                <p class="m-0">Адрес сервера:</p>
                <input type="text" name="server" placeholder="IP:Port" class="mb-5" required>
                <p class="m-0">Цена/Срок/Кол-во:</p>
                <select name="services_id" class="mb-5" required>
                    @foreach($services['vip'] as $service_top)
                        <option value="{{$service_top['services_id']}}">{{$service_top['name_services']}}</option>
                    @endforeach
                </select>
                <p class="m-0">Метод оплаты:</p>
                <select name="pay_type" class="mb-5" required>
                    <option value="wb">WebMoney (Merchant)</option>
                    <option value="fk">VISA/QIWI/Yandex и т.д... (Free-Kassa)</option>
                </select>
                <br>
                <button type="submit" class="mb-5">Оплатить</button>
            </form>
        </div>
        <div class="info-p w-300 mt-15">
            <h3 class="m-0">Выделения</h3>
            <form action="{{route('services_check')}}" method="post" class="m-0">
                @csrf
                <input type="hidden" name="services_form" value="allocations">
                <p class="m-0">Адрес сервера:</p>
                <input type="text" name="server" placeholder="IP:Port" class="mb-5" required>
                <p class="m-0">Цена/Срок/Цвет:</p>
                <select name="services_id" class="mb-5" required>
                    @foreach($services['allocations'] as $service_top)
                        <option value="{{$service_top['services_id']}}" style="background: {{$service_top['code_html']}};">{{$service_top['name_services']}}</option>
                    @endforeach
                </select>
                <p class="m-0">Метод оплаты:</p>
                <select name="pay_type" class="mb-5" required>
                    <option value="wb">WebMoney (Merchant)</option>
                    <option value="fk">VISA/QIWI/Yandex и т.д... (Free-Kassa)</option>
                </select>
                <br>
                <button type="submit" class="mb-5">Оплатить</button>
            </form>
        </div>
    </div>
    @if($status == 0 && isset($_COOKIE['debug_csgoms1']))
        <div class="info-p mb-5 mt-15">
            <p class="m-0">Lorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной "рыбой" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн. Его популяризации в новое время послужили публикация листов Letraset с образцами Lorem Ipsum в 60-х годах и, в более недавнее время, программы электронной вёрстки типа Aldus PageMaker, в шаблонах которых используется Lorem Ipsum.</p>
        </div>

        @if(isset($servers))
            <h2>Сервера кс го в раскрутке</h2>
            <table>
                <tr>
                    <th style="width: 20px; text-align: center">#</th>
                    <th style="width: 500px">Имя</th>
                    @if(!$agent->isMobile())
                        <th style="width: 185px">Карта</th>
                        <th style="width: 75px; text-align: center">Игроки</th>
                        <th style="width: 200px; text-align: center">IP:Port</th>
                        <th style="width: 120px; text-align: center">Услуга</th>
                    @endif
                </tr>
                @foreach($servers as $key=>$server)
                    <tr>
                        <td class="text-center">{{$key+1}}</td>
                        <td><a href="{{route('server_info', ['slug' => $server->ip.':'.$server->port])}}">{{Str::limit($server->name, $limit = 70, $end = '...')}}</a></td>
                        @if(!$agent->isMobile())
                            <td><a href="{{route('filter_map', $server->map)}}">{{$server->map}}</a></td>
                            <td style="text-align: center">{{$server->players}} / {{$server->maxplayers}}</td>
                            <td style="text-align: center">{{$server->ip}}:{{$server->port}}</td>
                            <td style="text-align: center">{{$server->rating}}</td>
                        @endif
                    </tr>
                @endforeach
            </table>
        @endif
    @endif
    <p class="text-center">Мы принимаем:</p>
    <div class="d-flex justify-content-center flex-wrap">
        <a href="https://passport.webmoney.ru/asp/certview.asp?wmid=210197498631" target="_blank" class="d-flex mr-5 mr-5 mb-5">
            <img src="{{asset('images/payment_system/88x31_wm_v_blue_on_white_ru.png')}}" title="Здесь находится аттестат нашего WM идентификатора 210197498631" border="0">
        </a>
        <a href="https://yandex.ru/" target="_blank" class="d-flex mr-5 mr-5 mb-5">
            <img src="{{asset('images/payment_system/yandexmon.png')}}" alt="yandex.ru" border="0"/>
        </a>
        <a href="#" target="_blank" class="d-flex mr-5 mr-5 mb-5">
            <img src="{{asset('images/payment_system/visa.png')}}" alt="" border="0"/>
        </a>
        <a href="https://megafon.ru" target="_blank" class="d-flex mr-5 mr-5 mb-5">
            <img src="{{asset('images/payment_system/megafon.png')}}" alt="" border="0"/>
        </a>
        <a href="http://beeline.ru/" target="_blank" class="d-flex mr-5 mr-5 mb-5">
            <img src="{{asset('images/payment_system/beeLine.png')}}" alt="" border="0"/>
        </a>
        <a href="http://mironline.ru" target="_blank" class="d-flex mr-5 mr-5 mb-5">
            <img src="{{asset('images/payment_system/mir.png')}}" alt="" border="0"/>
        </a>
        <a href="https://msk.tele2.ru" target="_blank" class="d-flex mr-5 mr-5 mb-5">
            <img src="{{asset('images/payment_system/tele2.png')}}" alt="" border="0"/>
        </a>
        <a href="#" target="_blank" class="d-flex mr-5 mr-5 mb-5">
            <img src="{{asset('images/payment_system/mtc.png')}}" alt="" border="0"/>
        </a>
        <a href="#" target="_blank" class="d-flex mr-5 mr-5 mb-5">
            <img src="{{asset('images/payment_system/mastercard.png')}}" alt="" border="0"/>
        </a>
        <a href="https://qiwi.com" target="_blank" class="d-flex mr-5 mr-5 mb-5">
            <img src="{{asset('images/payment_system/qiwi2.png')}}" alt="" border="0"/>
        </a>
    </div>
@endsection
