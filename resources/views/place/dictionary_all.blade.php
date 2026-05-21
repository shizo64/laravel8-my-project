@extends('layouts2.main')

@section('content')
<div class="container mb-5">
    <div class="text-center mb-4">
        <h2 class="fw-bold">Словарь всех тем</h2>
        <p class="text-white-50">Здесь собраны все категории и слова из них.</p>
    </div>

    @foreach($categories as $category)
        <div class="card bg-dark border-secondary bg-opacity-50 mb-4">
            <div class="card-header d-flex justify-content-between align-items-center bg-secondary bg-opacity-10 text-white">
                <div>
                    <h5 class="mb-1">{{ $category->title }}</h5>
                    <p class="mb-0 text-white-50 small">{{ $category->description ?? 'Описание отсутствует' }}</p>
                </div>
                <a href="{{ route('place.show', $category->id) }}" class="btn btn-outline-light btn-sm">Категория</a>
            </div>
            <div class="card-body p-0">
                @if($category->cards->isEmpty())
                    <div class="p-4 text-white-50">В этой категории пока нет слов.</div>
                @else
                    <div class="list-group list-group-flush">
                        @foreach($category->cards as $item)
                            @php
                                $t_en = $item->translations->first(fn($t) => optional($t->language)->code === 'en') ?? $item->translations->first();
                                $t_ru = $item->translations->where('id', '!=', optional($t_en)->id)->first();
                            @endphp
                            <div class="list-group-item bg-transparent border-secondary d-flex justify-content-between align-items-center text-white py-3">
                                <div>
                                    <span class="dictionary-word-cell me-2">{{ optional($t_en)->translation ?? '—' }}</span>
                                    <small class="text-white-50">{{ optional($t_en)->transcription ? '['.$t_en->transcription.']' : '' }}</small>
                                </div>
                                <div class="text-end fw-bold">{{ optional($t_ru)->translation ?? '—' }}</div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    @endforeach

    <div class="text-center mt-4">
        <a href="{{ route('place.index') }}" class="btn btn-secondary">Главная</a>
        <a href="{{ route('categories.index') }}" class="btn btn-outline-light ms-2">Категории</a>
    </div>
</div>
@endsection

@push('styles')
<style>
    .dictionary-word-cell { background-color: #60b3ff; padding: 4px 10px; border-radius: 6px; }
</style>
@endpush
