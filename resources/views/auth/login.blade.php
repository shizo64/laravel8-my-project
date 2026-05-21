@extends('layouts2.main')

@section('content')

<div class="container">

    <div class="auth-wrapper">

        <div class="card auth-card">
            <h2 class="text-center mb-3">Вход</h2>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- EMAIL -->
                <div class="mb-2">
                    <label>Email</label>
                    <input 
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                    >

                    @error('email')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- PASSWORD -->
                <div class="mb-2">
                    <label>Пароль</label>
                    <input 
                        id="password"
                        type="password"
                        name="password"
                        required
                    >

                    @error('password')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- REMEMBER + FORGOT -->
                <div class="auth-remember mb-3">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember" class="text-white mb-0">Запомнить меня</label>
                </div>

                <!-- BUTTON -->
                <button type="submit" class="btn btn-primary w-100">
                    Войти
                </button>

                <!-- RESET -->
                @if (Route::has('password.request'))
                    <div class="text-center mt-2">
                        <a href="{{ route('password.request') }}">
                            Забыли пароль?
                        </a>
                    </div>
                @endif

            </form>
        </div>

    </div>

</div>

@endsection