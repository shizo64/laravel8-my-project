@extends('layouts3.admin')

@section('content')
<div class="container mt-4">
    <div class="mb-3">
        <!-- Исправлено: ссылка теперь ведет на создание КАРТОЧКИ -->
        <a href="{{ route('admin.place.create') }}" class="btn btn-primary">Добавить карточку</a>
    </div>

    {{-- Выводим рабочие карточки --}}
    @foreach($places as $place)
        <div class="card mb-2 p-2 shadow-sm">
            <!-- Исправлено: ссылка на просмотр конкретной КАРТОЧКИ -->
            <a href="{{ route('admin.place.show', $place->id) }}" class="text-decoration-none">
                {{ $place->id }}. {{ $place->title }}
            </a>
        </div>
    @endforeach

    <div class="mt-3">
        {{-- Пагинация --}}
        {{ $places->withQueryString()->links() }}
    </div>
</div>
@endsection