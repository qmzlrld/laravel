@extends('layouts.app')

@section('content')
<div class="card" style="max-width: 620px; margin: 0 auto;">
    <div class="section-title">
        <h1>Регистрация</h1>
        <div class="tag">Все поля обязательны</div>
    </div>
    <form action="{{ route('register') }}" method="POST" class="grid two">
        @csrf
        <div>
            <label for="login">Логин (латиница/цифры, от 6)</label>
            <input type="text" id="login" name="login" value="{{ old('login') }}" required minlength="6" pattern="[A-Za-z0-9]{6,}">
            @error('login')<div class="error">{{ $message }}</div>@enderror
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            @error('email')<div class="error">{{ $message }}</div>@enderror
        </div>
        <div>
            <label for="full_name">ФИО (кириллица)</label>
            <input type="text" id="full_name" name="full_name" value="{{ old('full_name') }}" required>
            @error('full_name')<div class="error">{{ $message }}</div>@enderror
        </div>
        <div>
            <label for="phone">Телефон 8(XXX)XXX-XX-XX</label>
            <input type="text" id="phone" name="phone" placeholder="8(900)123-45-67" value="{{ old('phone') }}" required pattern="8\([0-9]{3}\)[0-9]{3}-[0-9]{2}-[0-9]{2}">
            @error('phone')<div class="error">{{ $message }}</div>@enderror
        </div>
        <div>
            <label for="password">Пароль (мин. 8)</label>
            <input type="password" id="password" name="password" required minlength="8">
            @error('password')<div class="error">{{ $message }}</div>@enderror
        </div>
        <div>
            <label for="password_confirmation">Повтор пароля</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required minlength="8">
        </div>
        <div class="actions" style="grid-column: 1 / -1;">
            <button type="submit" class="btn accent">Создать пользователя</button>
            <a href="{{ route('login') }}" class="btn">Уже есть аккаунт? Войти</a>
        </div>
    </form>
</div>
@endsection
