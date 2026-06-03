@extends('layouts2.main')

@section('content')
<div class="container mb-5">

    @if(isset($category))
        <div class="text-center mb-4">
            <h2 class="fw-bold text-white">{{ $category->title }}</h2>
            <p class="text-white-50">{{ $category->description ?? '' }}</p>
        </div>

        @if($cards->isEmpty())
            <div class="alert alert-secondary text-center">На сегодня все карточки выучены! Приходите позже.</div>
        @else
            <div class="row justify-content-between align-items-center mb-3">
                <div class="col-lg-6">
                    <ul class="nav nav-pills" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="cards-tab" data-bs-toggle="pill" data-bs-target="#cards-pane" type="button" role="tab" aria-controls="cards-pane" aria-selected="true">
                                Карточки
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="dictionary-tab" data-bs-toggle="pill" data-bs-target="#dictionary-pane" type="button" role="tab" aria-controls="dictionary-pane" aria-selected="false">
                                Словарь
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                    <a href="{{ route('place.dictionary', $category->id) }}" class="btn btn-outline-light btn-sm">Открыть словарь</a>
                </div>
            </div>

            <div class="text-center text-white mb-3">
                <span class="badge bg-primary">Осталось в сессии: <span id="cards-left">{{ $cards->count() }}</span></span>
            </div>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="cards-pane" role="tabpanel" aria-labelledby="cards-tab">
                    <div class="row justify-content-center">
                        <div class="col-lg-7 col-md-9">
                            <div id="mainCardCarousel" class="carousel slide carousel-fade" data-bs-interval="false" data-bs-touch="false">
                                <div class="carousel-inner" style="overflow: visible;">
                                    @foreach($cards as $index => $slideCard)
                                        @php
                                            $en = $slideCard->translations->first(fn($t) => optional($t->language)->code === 'en') ?? $slideCard->translations->first();
                                            $ru = $slideCard->translations->first(fn($t) => optional($t->language)->code === 'ru') ?? $slideCard->translations->last();
                                        @endphp

                                        <div class="carousel-item @if($index === 0) active @endif">
                                            <div class="flip-card mx-auto" onclick="this.classList.toggle('flipped')">
                                                <div class="flip-card-inner">
                                                    
                                                                                                    <div class="flip-card-front shadow-lg d-flex flex-column justify-content-center align-items-center">
                                                        @if($slideCard->image)
                                                            <div class="card-img-wrapper w-100">
                                                                <img src="{{ asset('images/cards/' . $slideCard->image) }}" class="card-img-top">
                                                            </div>
                                                        @endif
                                                        <div class="card-body text-center d-flex flex-column justify-content-center align-items-center p-4 flex-grow-1">
                                                            <h2 class="site-blue-text mb-1 fw-bold">{{ optional($en)->translation }}</h2>
                                                            @if(optional($en)->transcription)
                                                                <p class="text-white-50 fs-5">[{{ $en->transcription }}]</p>
                                                            @endif
                                                            <small style="color: rgba(255,255,255,0.3);">Кликните, чтобы перевернуть</small>
                                                        </div>
                                                    </div>

                                                    <div class="flip-card-back shadow-lg p-4">
                                                        <div class="d-flex flex-column justify-content-center align-items-center h-100">
                                                            <h2 class="text-white fw-bold mb-3">{{ optional($ru)->translation }}</h2>
                                                            
                                                            @auth
                                                                <div class="mt-4 d-flex gap-2">
                                                                    <button type="button" class="btn btn-danger btn-sm review-action" 
                                                                        data-url="{{ route('place.progress.update', $slideCard->id) }}" 
                                                                        data-rating="1">Hard</button>
                                                                    <button type="button" class="btn btn-warning btn-sm review-action" 
                                                                        data-url="{{ route('place.progress.update', $slideCard->id) }}" 
                                                                        data-rating="2">Good</button>
                                                                    <button type="button" class="btn btn-success btn-sm review-action" 
                                                                        data-url="{{ route('place.progress.update', $slideCard->id) }}" 
                                                                        data-rating="3">Easy</button>
                                                                </div>
                                                            @else
                                                                <small class="text-white-50">Войдите для сохранения прогресса</small>
                                                            @endauth
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="dictionary-pane" role="tabpanel" aria-labelledby="dictionary-tab">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="card bg-dark border-secondary bg-opacity-50">
                                <div class="card-body">
                                    <div class="list-group list-group-flush" id="dictionary-list">
                                        @foreach($cards as $item)
                                            @php
                                                $t_en = $item->translations->first(fn($t) => optional($t->language)->code === 'en') ?? $item->translations->first();
                                                $t_ru = $item->translations->first(fn($t) => optional($t->language)->code === 'ru');
                                            @endphp
                                            <div class="list-group-item bg-transparent border-secondary d-flex justify-content-between align-items-center text-white py-3">
                                                <div>
                                                    <span class="dictionary-word-cell me-2">{{ optional($t_en)->translation }}</span>
                                                    <small class="text-white-50">{{ optional($t_en)->transcription ? '['.$t_en->transcription.']' : '' }}</small>
                                                </div>
                                                <div class="text-end fw-bold">{{ optional($t_ru)->translation }}</div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endif
</div>
@endsection

@push('styles')
<style>
    .flip-card { perspective: 1200px; width: 100%; max-width: 450px; height: 500px; cursor: pointer; }
    .flip-card-inner { position: relative; width: 100%; height: 100%; transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1); 
    transform-style: preserve-3d; }
    .flip-card.flipped .flip-card-inner { transform: rotateY(180deg); }
    .flip-card-front, .flip-card-back { position: absolute; width: 100%; height: 100%; backface-visibility: hidden; 
    border-radius: 1.5rem; overflow: hidden; border: 1px solid rgba(255,255,255,0.1); }
    .flip-card-front { background-color: #1e293b; color: white; display: flex; flex-direction: column; }
    .card-img-wrapper { height: 250px; width: 100%; }
    .card-img-wrapper img { width: 100%; height: 100%; object-fit: cover; }
    .flip-card-back { background: #0f172a; color: white; transform: rotateY(180deg); display: flex; align-items: center;
     justify-content: center; border: 1px solid #60b3ff; }
    .site-blue-text { color: #60b3ff; }
    .dictionary-word-cell { background-color: #334155; border: 1px solid #60b3ff; padding: 4px 10px; border-radius: 6px; }
    .carousel-item { transition: transform 0.5s ease-in-out, opacity 0.5s ease-in-out; }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const carouselEl = document.getElementById('mainCardCarousel');
    if (!carouselEl) return;

    const carouselInstance = bootstrap.Carousel.getOrCreateInstance(carouselEl);
    const carouselInner = carouselEl.querySelector('.carousel-inner');

    // Сброс переворота при смене слайда
    carouselEl.addEventListener('slide.bs.carousel', function () {
        document.querySelectorAll('.flip-card').forEach(card => card.classList.remove('flipped'));
    });

    document.addEventListener('click', async function (event) {
        const button = event.target.closest('.review-action');
        if (!button) return;

        event.preventDefault();
        event.stopPropagation();

        const rating = button.dataset.rating;
        const url = button.dataset.url;
        const activeItem = document.querySelector('.carousel-item.active');

        button.disabled = true;

        try {
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ rating: Number(rating) }),
            });

            if (response.ok) {
                // Переключаем карусель
                carouselInstance.next();

                setTimeout(() => {
                    if (rating == 1) {
                        // --- ЛОГИКА HARD (Anki Loop) ---
                        // Убираем класс active и переставляем в конец списка
                        activeItem.classList.remove('active');
                        carouselInner.appendChild(activeItem);
                        console.log('Hard: карточка перемещена в конец очереди');
                    } else {
                        // --- ЛОГИКА EASY/GOOD ---
                        activeItem.remove();
                        console.log('Easy/Good: карточка удалена из сессии');
                    }

                    // Обновляем счетчик
                    const remaining = document.querySelectorAll('.carousel-item').length;
                    document.getElementById('cards-left').innerText = remaining;

                    // Если пусто - перезагружаем для экрана "Всё выучено"
                    if (remaining === 0) {
                        window.location.reload();
                    }
                }, 600); // Задержка, пока идет анимация перехода карусели
            }
        } catch (error) {
            console.error('Network error:', error);
        } finally {
            button.disabled = false;
        }
    });
});
</script>
@endpush