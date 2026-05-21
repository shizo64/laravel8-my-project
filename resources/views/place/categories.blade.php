@extends('layouts2.main')
@section('title', 'Все категории')

@section('content')
<div class="container my-5">
    <div class="mb-5 text-center">
        <h1 class="text-white">Все категории</h1>
        <p class="text-white-50">Выберите тему и начните повторять слова из удобных карточек.</p>
    </div>

    <div class="row g-4">
        @forelse($categories as $category)
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="card h-100 border-0 rounded-3 overflow-hidden" style="background: #1e293b;">

                    @if($category->image)
                        @php
                            $src = str_starts_with($category->image, 'http')
                                ? $category->image
                                : asset('images/categories/' . $category->image);
                        @endphp
                        <img src="{{ $src }}" class="card-img-top" style="height: 160px; object-fit: cover;" alt="{{ $category->title }}">
                    @else
                        <div style="height: 160px; background: #334155; display: flex; align-items: center; justify-content: center;">
                            <span style="font-size: 3rem;">📚</span>
                        </div>
                    @endif

                    <div class="card-body d-flex flex-column p-4">
                        <h5 class="text-white fw-bold">{{ $category->title }}</h5>
                        <p class="text-white-50 flex-grow-1">
                            {{ \Illuminate\Support\Str::limit($category->description ?? 'Описание отсутствует', 110) }}
                        </p>
                        <a href="{{ route('place.show', $category->id) }}" class="btn btn-primary mt-auto">
                            Открыть категорию
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-secondary">Пока нет категорий. Добавьте их в админке.</div>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-5">
        {{ $categories->links() }}
    </div>
</div>
@endsection