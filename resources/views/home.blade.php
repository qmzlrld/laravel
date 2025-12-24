@extends('layouts.app')

@section('content')
<div class="grid two">
    <div class="card">
        <div class="section-title">
            <h1>Бронирование столика</h1>
            <div class="tag">Главная страница</div>
        </div>
        @auth
            <form action="{{ route('bookings.store') }}" method="POST" class="grid">
                @csrf
                <div class="grid two">
                    <div>
                        <label for="date">Дата</label>
                        <input type="date" id="date" name="date" value="{{ old('date') }}" min="{{ now()->toDateString() }}" required>
                        @error('date')<div class="error">{{ $message }}</div>@enderror
                    </div>
                    <div>
                        <label for="time">Время</label>
                        <input type="time" id="time" name="time" value="{{ old('time') }}" required>
                        @error('time')<div class="error">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="grid two">
                    <div>
                        <label for="guests">Количество гостей</label>
                        <input type="number" id="guests" name="guests" min="1" max="20" value="{{ old('guests', 2) }}" required>
                        @error('guests')<div class="error">{{ $message }}</div>@enderror
                    </div>
                    <div>
                        <label for="comment">Пожелания</label>
                        <textarea id="comment" name="comment" placeholder="Предпочтения по столу или времени">{{ old('comment') }}</textarea>
                        @error('comment')<div class="error">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="actions">
                    <button type="submit" class="btn accent">Отправить заявку</button>
                    <span class="muted">Статус заявки: Новая → Администратор подтвердит или отменит</span>
                </div>
            </form>
            <script>
                // Set min date using client local time to avoid timezone mismatch
                (() => {
                    const input = document.getElementById('date');
                    if (!input) return;
                    const today = new Date();
                    const yyyy = today.getFullYear();
                    const mm = String(today.getMonth() + 1).padStart(2, '0');
                    const dd = String(today.getDate()).padStart(2, '0');
                    const iso = `${yyyy}-${mm}-${dd}`;
                    input.min = iso;
                    if (input.value && input.value < iso) {
                        input.value = iso;
                    }
                })();
            </script>
        @else
            <p class="muted">Для отправки заявки войдите или создайте аккаунт.</p>
            <div class="actions">
                <a class="btn accent" href="{{ route('login') }}">Войти</a>
                <a class="btn" href="{{ route('register') }}">Регистрация</a>
            </div>
        @endauth
    </div>

    <div class="card">
        <div class="section-title">
            <h2>Мои последние заявки</h2>
            <div class="tag">Последние 5</div>
        </div>
        @if(auth()->check() && $bookings->isNotEmpty())
            <table>
                <thead>
                <tr>
                    <th>Дата</th>
                    <th>Гости</th>
                    <th>Статус</th>
                </tr>
                </thead>
                <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->reservation_at->format('d.m.Y H:i') }}</td>
                        <td>{{ $booking->guests }}</td>
                        <td><span class="pill {{ $booking->status }}">{{ $booking->status_label }}</span></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @elseif(auth()->check())
            <p class="muted">Заявок пока нет.</p>
        @else
            <p class="muted">Авторизуйтесь, чтобы увидеть ваши заявки.</p>
        @endif
    </div>
</div>
@endsection
