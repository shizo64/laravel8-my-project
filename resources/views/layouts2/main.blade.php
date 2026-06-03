<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'English Cards'))</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('registers/css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('testV001/css_sait.css') }}">
    @stack('styles')
</head>
<body class="bg-dark text-white d-flex flex-column min-vh-100">

        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
    <div class="container">
        <!-- Название сайта -->
        <a class="navbar-brand" href="{{ route('place.index') }}">
            English Cards
        </a>


        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <!-- ЛЕВАЯ ЧАСТЬ -->
            <ul class="navbar-nav me-auto">
            @auth
            @if(Auth::user()->role === 'admin')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.category.index') }}">Admin panel</a>
                </li>
            @endif
            @endauth

                <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                        <a class="nav-link" href="{{ route('categories.index') }}">Категории</a>
                </li>
                <li class="nav-item">
                        <a class="nav-link" href="{{ route('dictionary.index') }}">Словарь</a>
                </li>
            </ul>

            <!-- ПРАВАЯ ЧАСТЬ -->
            <ul class="navbar-nav ms-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Логин</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Регистрация</a>
                    </li>
                @endguest

                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="{{ route('home') }}">Профиль</a>
                            <a class="dropdown-item text-danger"
                               href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Выйти
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endauth
            </ul>

        </div>
    </div>
</nav>

<main class="site-main flex-fill">
    <div class="container my-5">
        @yield('content')
    </div>
</main>

<footer class="site-footer py-5 mt-5 text-light">
    <div class="container">
        <div class="row gy-4">
            <div class="col-md-4">
                <h5>English Cards</h5>
                <p>Простой сервис для изучения английского через карточки. Учите слова, фразы и выражения в удобном формате.</p>
            </div>
            <div class="col-sm-6 col-md-2">
                <h6>Ссылки</h6>
                <ul class="list-unstyled footer-links">
                    <li><a href="{{ route('place.index') }}">Карточки</a></li>
                    <li><a href="{{ route('categories.index') }}">Все категории</a></li>
                    <li><a href="#">Политика конфиденциальности</a></li>
                    <li><a href="#">Условия использования</a></li>
                </ul>
            </div>
            <div class="col-sm-6 col-md-3">
                <h6>Мы в соцсетях</h6>
                <div class="social-links d-flex gap-3">
                    <a href="#" aria-label="Telegram" class="social-icon">Telegram</a>
                    <a href="#" aria-label="YouTube" class="social-icon">YouTube</a>
                </div>
            </div>
            <div class="col-sm-12 col-md-3">
                <h6>Контакты</h6>
                <p class="mb-1">support@example.com</p>
                <p>+7 900 000-00-00</p>

            </div>
        </div>

        <div class="footer-bottom d-flex flex-column flex-md-row justify-content-between align-items-center mt-4 pt-4 border-top border-light opacity-75">
            <p class="mb-2 mb-md-0">&copy; {{ date('Y') }} English Cards. Все права защищены.</p>
            <p class="mb-0">Разработано для удобного изучения английского.</p>
        </div>
    </div>
</footer>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
@stack('scripts')
</html>