@extends('layouts3.admin')

@section('content')
<div class="container">
    <h1>Категория: {{ $category->title }}</h1>

    <!-- Форма добавления: Слово, Перевод и Транскрипция -->
{{-- resources/views/admin/categories/show.blade.php --}}

<form action="{{ route('admin.card.store') }}" method="POST" class="mb-4 shadow-sm p-3 bg-light rounded">
    @csrf
    <input type="hidden" name="category_id" value="{{ $category->id }}">
    
    <div class="row g-3 align-items-end">
        <div class="col-md-3">
            <label class="form-label small fw-bold">Слово (Русский)</label>
            <input type="text" name="word_ru" class="form-control" placeholder="Кот" required>
        </div>
        <div class="col-md-3">
            <label class="form-label small fw-bold">Перевод (Иностранный)</label>
            <input type="text" name="word_target" class="form-control" placeholder="Cat" required>
        </div>
        <div class="col-md-3">
            <label class="form-label small fw-bold">Транскрипция</label>
            <input type="text" name="transcription" class="form-control" placeholder="[kæt]">
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-primary w-100">Создать карточку</button>
        </div>
    </div>
</form>
    <hr>

    <div class="row">
        @foreach($category->cards as $card)
            <div class="col-md-4 mb-3">
                <div class="card p-3">
                    @php
                        // Находим русский перевод
                        $ru = $card->translations->where('language_id', 1)->first();
                        // Находим иностранный перевод
                        $target = $card->translations->where('language_id', 2)->first();
                    @endphp
                    
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <strong class="text-secondary small">RU:</strong>
                            <h5>{{ $ru->translation ?? '—' }}</h5>
                        </div>
                        <div class="text-end">
                            <strong class="text-secondary small">Target:</strong>
                            <h5 class="text-primary">{{ $target->translation ?? '—' }}</h5>
                            <small class="text-muted">[{{ $target->transcription ?? '' }}]</small>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection