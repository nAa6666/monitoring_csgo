@if(!$agent->isMobile())
    {{--<div class="top-servers mt-15 d-flex justify-content-between align-items-center flex-wrap">
        @foreach(Api::getTopServers() as $top_srv)
            <div class="item-top">
                <div class="name-top d-flex align-items-center mb-5">
                    <p class="m-0 crop-t"><a href="{{route('server_info', ['slug' => $top_srv->ip.':'.$top_srv->port])}}">{{$top_srv->name}}</a></p>
                </div>
                <div class="d-flex align-items-center">
                    <div class="img-top">
                        @if(is_file(sprintf('images/maps/%s.jpg', $top_srv->map)))
                            <img src="{{asset(sprintf('images/maps/%s.jpg', $top_srv->map))}}" alt="Карта {{$top_srv->map}}">
                        @else
                            <img src="{{asset('images/maps/default.jpg')}}" alt="Карта {{$top_srv->map}}">
                        @endif
                    </div>
                    <div class="inf-top ml-5">
                        <p class="m-0 owt">Карта: <a href="{{route('filter_map', $top_srv->map)}}">{{$top_srv->map}}</a></p>
                        <p class="m-0">Игроки: {{$top_srv->players}} / {{$top_srv->maxplayers}}</p>
                        <p class="m-0">Статус: {{$top_srv->status == 'Online' ? 'Онлайн' : 'Оффлайн'}}</p>
                        <p class="m-0 owt">{{$top_srv->ip}}:{{$top_srv->port}}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>--}}
@endif
