@extends('admin.layout')
@section('title', 'Админ - Список серверов')
@section('admin.content')
    <div class="content-header">
        <div class="bredcr">
            <h1>Все новости</h1>
            <a class="btn b-blue" href="{{route('admin.news.create')}}"><i class="fa fa-plus icn14" aria-hidden="true"></i> Добавить</a>
        </div>
    </div>

    @php if(session()->has('success')) $success = session()->get('success'); @endphp
    @if(isset($success))
        <div class="alert alert-success">
            <i class="fa fa-check" aria-hidden="true"></i>
            <span>{{ $success }}</span>
        </div>
    @endif

    <div class="card">
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <tbody>
                <tr>
                    <td class="text-center" width="5%">ID</td>
                    <td width="30%">Имя</td>
                    <td class="text-center" width="25%">Дата создания</td>
                    <td width="15%" class="text-center">Просмотров</td>
                    <td class="text-center" width="25%">Действия</td>
                </tr>
                @foreach($news as $key=>$post)
                    <tr>
                        <td width="5%" class="text-center">{{$key + 1}}</td>
                        <td width="30%"><a class="tt-line" href="{{route('admin.news.show', $post->id)}}"><p>{{$post->title}}</p></a></td>
                        <td width="25%" class="text-center">{{$post->created_at}}</td>
                        <td width="15%" class="text-center">{{$post->views}}</td>
                        <td width="25%" class="text-center d-flex align-items-center justify-content-center w100">
                            <a class="btn b-blue" href="{{route('admin.news.edit', $post->id)}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Ред.</a>
                            <form action="{{route('admin.news.destroy', $post->id)}}" method="POST">
                                @method('DELETE') {{ csrf_field() }}
                                <button type="submit" class="btn b-red">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i> Удалить
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
