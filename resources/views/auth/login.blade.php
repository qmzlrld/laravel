@extends('layouts.app')

@section('content')
<div class="card" style="max-width: 520px; margin: 0 auto;">
    <div class="section-title">
        <h1>Вход</h1>
        <div class="tag">Доступ к профилю</div>
    </div>
    <form action="{{ route('login') }}" method="POST" class="grid">
        @csrf
        <div>
            <label for="login">Логин</label>
            <input type="text" id="login" name="login" value="{{ old('login') }}" required minlength="6">
            @error('login')<div class="error">{{ $message }}</div>@enderror
        </div>
        <div>
            <label for="password">Пароль</label>
            <input type="password" id="password" name="password" required minlength="8">
            @error('password')<div class="error">{{ $message }}</div>@enderror
        </div>
        <div class="actions">
            <label style="display:flex; align-items:center; gap:6px; font-size:14px; color:var(--muted);">
                <input type="checkbox" name="remember" value="1" style="width:16px; height:16px;">
                Запомнить меня
            </label>
        </div>
        <div class="actions">
            <button type="submit" class="btn accent">Войти</button>
            <a href="{{ route('register') }}" class="btn">Еще не зарегистрированы? Регистрация</a>
        </div>
    </form>
</div>
@endsection
