@extends('layouts2.main')

@section('content')
<div class="container mb-5">
    <div class="text-center mb-4">
        <h2 class="fw-bold">Словарь категории: {{ $category->title }}</h2>
        <p class="text-white-50">{{ $category->description ?? 'Описание отсутствует' }}</p>
    </div>

    @if($cards->isEmpty())
        <div class="alert alert-secondary text-center">В этой категории пока нет слов.</div>
    @else
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card bg-dark border-secondary bg-opacity-50">
                    <div class="card-body">
                        <h4 class="mb-4 text-white">Словарь</h4>
                        <div class="list-group list-group-flush">
                            @foreach($cards as $item)
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
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="text-center mt-4">
        <a href="{{ route('place.show', $category->id) }}" class="btn btn-outline-light">Вернуться к карточкам</a>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary ms-2">Все категории</a>
    </div>
</div>
@endsection

@push('styles')
<style>
    .dictionary-word-cell { background-color: #60b3ff; padding: 4px 10px; border-radius: 6px; }
</style>
@endpush
