@extends('layouts3.admin')

@section('content')
<div class="container mt-4">
    <h2>Просмотр карточки: {{ $place->title }}</h2>
    
    <div class="card shadow-sm mt-3">
        <div class="card-body">
            <p><strong>Слово (EN):</strong> {{ $place->title }}</p>
            <p><strong>Транскрипция:</strong> {{ $place->transcription }}</p>
            <p><strong>Перевод (RU):</strong> {{ $place->translation }}</p>
            
            <!-- Исправлено: обращаемся к категории через связь карточки -->
            <p><strong>Категория:</strong> 
                @if($place->category)
                    {{ $place->category->title }}
                @else
                    <span class="text-muted">Без категории</span>
                @endif
            </p>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('admin.category.show', $place->category_id) }}" class="btn btn-secondary">Назад к категории</a>
    </div>
</div>
@endsection