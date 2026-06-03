@extends('layouts3.admin')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4>Редактировать категорию: {{ $category->title }}</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                
                <div class="mb-3">
                    <label for="title" class="form-label">Название категории</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $category->title }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Текущее изображение</label><br>
                    @if($category->image)
                <img src="{{ str_starts_with($category->image, 'http') ? $category->image : asset('images/categories/' . $category->image) }}" 
                    @endif
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Загрузить новое изображение</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                </div>

                <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                <a href="{{ route('admin.category.index') }}" class="btn btn-secondary">Отмена</a>
            </form>
        </div>
    </div>
</div>
@endsection