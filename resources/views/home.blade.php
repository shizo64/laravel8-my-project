@extends('layouts2.main')

@section('content')
<div class="container mb-5">
    <div class="text-center mb-4">
        <h2 class="fw-bold">Добро пожаловать, {{ Auth::user()->name ?? 'Гость' }}!</h2>
        <p class="text-white-50">Это ваш личный кабинет. Здесь вы можете перейти к категориям, карточкам и общему словарю.</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card bg-dark border-secondary bg-opacity-50">
                <div class="card-body">
                    <div class="d-flex flex-column gap-3">
                        <a href="{{ route('place.index') }}" class="btn btn-outline-light">Главная страница</a>
                        <a href="{{ route('categories.index') }}" class="btn btn-outline-light">Категории</a>
                        <a href="{{ route('dictionary.index') }}" class="btn btn-outline-light">Глобальный словарь</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
