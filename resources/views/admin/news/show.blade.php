@extends('admin.layout')
@section('title', 'Админ - Новость - '.$news->title)
@section('admin.content')
    <div class="content-header">
        <div class="bredcr">
            <h1>Просмотр - {{$news->title}}</h1>
        </div>
    </div>
    @if(isset($success))
        <div class="alert alert-success">
            <i class="fa fa-check" aria-hidden="true"></i>
            <span>{{ $success }}</span>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <h2 class="mr-1">{{$news->title}}</h2> <span>(<i class="fa fa-eye" aria-hidden="true"></i> {{$news->views}})</span>
            </div>
            <span><b>Дата создания:</b> {{$news->created_at}}</span> <span><b>Дата обновления:</b> {{$news->updated_at}}</span>
            <br><br>
            {!! $news->description !!}
        </div>
    </div>
@endsection
