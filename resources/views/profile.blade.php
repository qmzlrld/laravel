@extends('layouts.app')

@section('content')
<div class="grid two">
    <div class="card">
        <div class="section-title">
            <h1>Профиль</h1>
            <div class="tag">Данные пользователя</div>
        </div>
        <div class="grid">
            <div><strong>Логин:</strong> {{ $user->login }}</div>
            <div><strong>ФИО:</strong> {{ $user->full_name }}</div>
            <div><strong>Телефон:</strong> {{ $user->phone }}</div>
            <div><strong>Email:</strong> {{ $user->email }}</div>
        </div>
    </div>

    <div class="card">
        <div class="section-title">
            <h2>История заявок</h2>
            <div class="tag">Пагинация</div>
        </div>
        @if($bookings->count())
            <table>
                <thead>
                <tr>
                    <th>Дата</th>
                    <th>Гости</th>
                    <th>Статус</th>
                    <th>Комментарий</th>
                </tr>
                </thead>
                <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->reservation_at->format('d.m.Y H:i') }}</td>
                        <td>{{ $booking->guests }}</td>
                        <td><span class="pill {{ $booking->status }}">{{ $booking->status_label }}</span></td>
                        <td>{{ $booking->comment ?: '—' }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div style="margin-top: 12px;">{{ $bookings->links() }}</div>
        @else
            <p class="muted">Заявок пока нет.</p>
        @endif
    </div>
</div>
@endsection
