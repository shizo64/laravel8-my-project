@extends('layouts3.admin')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4>Создать новую карточку (Place)</h4>
        </div>
        <div class="card-body">
            <!-- МЫ ВЕРНУЛИ admin.place.store, так как у тебя всё настроено на place -->
            <form action="{{ route('admin.card.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label font-weight-bold">Слово (English)</label>
                    <input type="text" name="word_target" class="form-control" 
                        placeholder="Например: Apple" value="{{ old('word_target') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label font-weight-bold">Транскрипция</label>
                    <input type="text" name="transcription" class="form-control" 
                        placeholder="[ˈæpl]" value="{{ old('transcription') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label font-weight-bold">Перевод (Russian)</label>
                    <input type="text" name="word_ru" class="form-control" 
                        placeholder="Яблоко" value="{{ old('word_ru') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label font-weight-bold">Категория</label>
                    <select name="category_id" class="form-select">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                    <a href="{{ route('admin.category.index') }}" class="btn btn-link">Отмена</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection