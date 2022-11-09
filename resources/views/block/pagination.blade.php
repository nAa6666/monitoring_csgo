@php
    $pagination = [];
    $noactive = $servers->currentPage() + 2;
    if($pages > 2) {
        for($i = 1; $i < $pages; $i++) {
            if(($i == $servers->currentPage()) || ($i == 1 && $servers->currentPage() <= 1) || ($servers->currentPage() > $i && $i == $pages-1)) {
                $pagination[$i]['all']['active'] = $i;
            }
            else if($i > $noactive && $i < $pages-1){
                $pagination[$noactive+1]['all']['noactive'] = true;
            }
            else if($i != 1 && $i < $servers->currentPage()-2){
                 $pagination[$servers->currentPage()-3]['all']['noactive'] = true;
            }
            else {
                $pagination[$i]['all']['n'] = $i;
            }
        }
    }
    //dd(\Request::route()->parameters);
    //dd($route);
@endphp
@if ($pages > 2)
    <div class="pagination mt-15 d-flex">
        <span class="mr-5">Страницы: </span>
        <ul class="d-flex">
            @foreach ($pagination as $key=>$all)
                @foreach ($all as $val)
                    @foreach ($val as $key2=>$val2)
                        @if($key2 == 'active')
                            @if($key == 1)
                                <li class="page-item active green ml-5 mr-5"><span class="page-link">{{$val2}}</span></li>
                            @else
                                <li class="page-item active green ml-5 mr-5"><span class="page-link">{{$val2}}</span></li>
                            @endif
                        @endif
                        @if($key2 == 'noactive' && $val2)
                            <li class="page-item ml-5 mr-5"><span class="page-link">...</span></li>
                        @endif
                        @if($key2 != 'active' && $key2 != 'noactive')
                            @if($key == 1)
                                <li class="page-item ml-5 mr-5"><a href="{{route(\Request::route()->getName(), \Request::route()->parameters)}}" class="page-link">{{$val2}}</a></li>
                            @else
                                <li class="page-item ml-5 mr-5"><a class="page-link" href="{{route(\Request::route()->getName(), \Request::route()->parameters)}}?page={{$val2}}">{{$val2}}</a></li>
                            @endif
                        @endif
                    @endforeach
                @endforeach
            @endforeach
        </ul>
    </div>
@endif
