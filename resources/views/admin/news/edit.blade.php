@extends('admin.layout')
@section('title', 'Админ - Редактирование новости')

@push('scripts')
    <script src="{{asset('js/ckeditor/ckeditor.js')}}"></script>
@endpush

@section('admin.content')
    <div class="content-header">
        <div class="bredcr">
            <h1>Редактировать новость - {{$news->title}}</h1>
        </div>
    </div>
    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">
                <i class="fa fa-times" aria-hidden="true"></i>
                <span style="font-weight: bold;">{{ $error }}</span>
            </div>
        @endforeach
    @endif
    <form action="{{route('admin.news.update', $news->id)}}" method="post">
        @csrf
        @csrf @method('PUT')
        <div id="news" class="card">
            <div class="card-body">
                <div class="form-group mb-5">
                    <p>Заголовок</p>
                    <input type="text" name="title" class="formAdm" required value="{{$news->title}}">
                </div>
                <div class="form-group">
                    <p>Описание</p>
                    <textarea id="description" class="formAdm" name="description" required>{{$news->description}}</textarea>
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            var editor = CKEDITOR.replace('description');
                            editor.on('required', function(evt) {
                                editor.showNotification('Описание не может быть пустым.', 'warning');
                                evt.cancel();
                            });
                        });
                    </script>
                </div>
                <h3>SEO (Search Engine Optimization)</h3>
                <div class="form-group">
                    <p>Meta Title</p>
                    <input type="text" name="meta_title" class="formAdm" required value="{{$news->meta_title}}">
                </div>
                <div class="form-group">
                    <p>Meta Description</p>
                    <textarea class="formAdm" name="meta_description" rows="4" cols="50" required>{{$news->meta_description}}</textarea>
                </div>
                <div class="form-group">
                    <p>Meta Keywords</p>
                    <input type="text" name="meta_keywords" class="formAdm" required value="{{$news->meta_keywords}}">
                </div>
            </div>
        </div>
        <button class="btn b-blue" type="submit">Сохранить</button>
    </form>
@endsection
