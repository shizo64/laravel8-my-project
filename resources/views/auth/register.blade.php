@extends('layouts2.main')

@section('content')

<div class="container">

    <div class="auth-wrapper">

        <div class="card auth-card">
            <h2 class="text-center mb-3">Регистрация</h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- NAME -->
                <div class="mb-2">
                    <label>Имя</label>
                    <input 
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        autofocus
                    >

                    @error('name')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- EMAIL -->
                <div class="mb-2">
                    <label>Email</label>
                    <input 
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
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

                <!-- CONFIRM -->
                <div class="mb-2">
                    <label>Повторите пароль</label>
                    <input 
                        id="password-confirm"
                        type="password"
                        name="password_confirmation"
                        required
                    >
                </div>

                <!-- BUTTON -->
                <button type="submit" class="btn btn-primary w-100">
                    Зарегистрироваться
                </button>

                <!-- LOGIN LINK -->
                <div class="text-center mt-2">
                    <a href="{{ route('login') }}">
                        Уже есть аккаунт? Войти
                    </a>
                </div>

            </form>
        </div>

    </div>

</div>

@endsection