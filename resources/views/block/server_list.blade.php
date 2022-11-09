<table>
    <tr class="d-flex">
        <th class="tb_number text-center">#</th>
        <th class="tb_name">Имя</th>
        @if(!$agent->isMobile())
            <th class="tb_map">Карта</th>
            <th class="tb_players text-center">Игроки</th>
            <th class="tb_address text-center">IP:Port</th>
            <th class="tb_rate text-center">Рейтинг</th>
        @endif
    </tr>
    @foreach($servers as $key=>$server)
        <tr class="d-flex">
            <td class="tb_number text-center">{{$key+1}}</td>
            <td class="tb_name"><a href="{{route('server_info', ['slug' => $server->ip.':'.$server->port])}}">{{$server->name}}</a></td>
            @if(!$agent->isMobile())
                <td class="tb_map"><a href="{{route('filter_map', $server->map)}}">{{$server->map}}</a></td>
                <td class="tb_players text-center">{{$server->players}} / {{$server->maxplayers}}</td>
                <td class="tb_address text-center">{{$server->ip}}:{{$server->port}}</td>
                <td class="tb_rate text-center">{{$server->rating}}</td>
            @endif
        </tr>
    @endforeach
</table>
