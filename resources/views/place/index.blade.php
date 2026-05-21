@extends('layouts2.main')
@section('title', 'Главная')

@section('content')

<!-- ===== КАРУСЕЛЬ ===== -->
<div id="welcomeCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#welcomeCarousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#welcomeCarousel" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#welcomeCarousel" data-bs-slide-to="2"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ asset('images/Home/HomeSlider/slideImg1.jpg') }}" class="d-block w-100" alt="Изучай английский">
            <div class="carousel-caption">
                <h2>Добро пожаловать</h2>
                <p>Изучай английский через карточки</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="{{ asset('images/Home/HomeSlider/slideImg2.jpg') }}" class="d-block w-100" alt="Разные категории">
            <div class="carousel-caption">
                <h2>Разные категории</h2>
                <p>Слова, фразы и выражения</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="{{ asset('images/Home/HomeSlider/slideImg3.jpg') }}" class="d-block w-100" alt="Учись в своём темпе">
            <div class="carousel-caption">
                <h2>Учись в своем темпе</h2>
                <p>Повторяй и запоминай</p>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#welcomeCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#welcomeCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>

<!-- ===== HERO ===== -->
<div class="hero text-center py-5">
    <h1 class="text-white fw-bold">Изучай английский легко</h1>
    <p class="text-white-50 fs-5">Карточки, практика и повторение каждый день</p>
    <a href="{{ route('categories.index') }}" class="btn btn-outline-light btn-lg mt-3">
        Смотреть все категории
    </a>
</div>

<!-- ===== О НАС ===== -->
<div class="container mb-5">
    <div class="p-4 rounded-3" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);">
        <h3 class="text-white">О нас</h3>
        <p class="text-white-50 mb-0">
            Мы сделали простой и удобный сервис для изучения английского языка через карточки.
            Никакой перегрузки — только практика и результат.
        </p>
    </div>
</div>

<!-- ===== ПОПУЛЯРНЫЕ КАТЕГОРИИ ===== -->
<div class="container mb-5">
    <h3 class="text-white mb-4">Популярные категории</h3>

    <div class="row g-4">
        @forelse($categories->take(3) as $category)
            <div class="col-md-4">
                <div class="card h-100 border-0 rounded-3 overflow-hidden" style="background: #1e293b;">

                    @if($category->image)
                        @php
                            $src = str_starts_with($category->image, 'http')
                                ? $category->image
                                : asset('images/categories/' . $category->image);
                        @endphp
                        <img src="{{ $src }}" class="card-img-top" style="height: 180px; object-fit: cover;" alt="{{ $category->title }}">
                    @else
                        <div style="height: 180px; background: #334155; display: flex; align-items: center; justify-content: center;">
                            <span style="font-size: 3rem;">📚</span>
                        </div>
                    @endif

                    <div class="card-body d-flex flex-column p-4">
                        <h5 class="text-white fw-bold">{{ $category->title }}</h5>
                        <p class="text-white-50 flex-grow-1">
                            {{ \Illuminate\Support\Str::limit($category->description ?? 'Описание отсутствует', 80) }}
                        </p>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <small class="text-white-50">Слов: {{ $category->cards->count() }}</small>
                            <a href="{{ route('place.show', $category->id) }}" class="btn btn-primary btn-sm">
                                Открыть →
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-white-50 text-center">Категорий пока нет.</p>
            </div>
        @endforelse
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('categories.index') }}" class="btn btn-outline-light">
            Смотреть все категории
        </a>
    </div>
</div>

@endsection