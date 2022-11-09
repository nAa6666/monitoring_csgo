@if (count($breadcrumbs))
    <div class="breadcrumb mb-5">
        <ul itemscope itemtype="http://schema.org/BreadcrumbList" class="d-flex">
            @foreach ($breadcrumbs as $key=>$breadcrumb)
                @if ($breadcrumb->url && !$loop->last)
                    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="breadcrumb-item">
                        <a itemprop="item" href="{{ $breadcrumb->url }}">
                            <span itemprop="name">{{ $breadcrumb->title }}</span>
                            <meta itemprop="position" content="{{$key + 1}}" />
                        </a>
                    </li>
                @else
                    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"  class="breadcrumb-item active">
                        <span itemprop="name">{{ $breadcrumb->title }}</span>
                        <meta itemprop="position" content="{{$key + 1}}" />
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
@endif
