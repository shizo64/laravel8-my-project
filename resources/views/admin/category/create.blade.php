@extends('layouts3.admin')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4><i class="fas fa-folder-plus"></i> Создать новую категорию</h4>
        </div>
        <div class="card-body">
            <!-- ВАЖНО: action ведет на сохранение КАТЕГОРИИ, а не карточки -->
            <form action="{{ route('admin.category.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label font-weight-bold">Название категории</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" 
                           placeholder="Например: Еда, Транспорт, Глаголы" value="{{ old('title') }}">
                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label font-weight-bold">Описание (необязательно)</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="О чем эта категория?">{{ old('description') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label font-weight-bold">Изображение или Иконка (URL)</label>
                    <input type="text" name="image" class="form-control" placeholder="http://example.com/image.jpg" value="{{ old('image') }}">
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg">Сохранить категорию</button>
                    <a href="{{ route('admin.category.index') }}" class="btn btn-link text-secondary">Отмена</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection