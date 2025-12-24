@extends('layouts.app')

@section('content')
<div class="card">
    <div class="section-title">
        <h1>Панель администратора</h1>
        <div class="tag">Управление заявками</div>
    </div>
    <form method="GET" class="actions" style="margin-bottom: 14px;">
        <label for="status" style="color:var(--muted);">Фильтр по статусу</label>
        <select id="status" name="status" onchange="this.form.submit()" style="max-width: 180px;">
            <option value="">Все</option>
            @foreach($statusLabels as $key => $label)
                <option value="{{ $key }}" @selected($currentStatus === $key)>{{ $label }}</option>
            @endforeach
        </select>
    </form>

    @if($bookings->count())
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Пользователь</th>
                <th>Дата</th>
                <th>Гости</th>
                <th>Комментарий</th>
                <th>Статус</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($bookings as $booking)
                <tr>
                    <td>#{{ $booking->id }}</td>
                    <td>
                        <div><strong>{{ $booking->user->full_name }}</strong></div>
                        <div class="muted">{{ $booking->user->phone }} · {{ $booking->user->email }}</div>
                    </td>
                    <td>{{ $booking->reservation_at->format('d.m.Y H:i') }}</td>
                    <td>{{ $booking->guests }}</td>
                    <td>{{ $booking->comment ?: '—' }}</td>
                    <td><span class="pill {{ $booking->status }}">{{ $booking->status_label }}</span></td>
                    <td>
                        <form action="{{ route('admin.bookings.updateStatus', $booking) }}" method="POST" class="actions">
                            @csrf
                            @method('PATCH')
                            <select name="status">
                                @foreach($statusLabels as $key => $label)
                                    <option value="{{ $key }}" @selected($booking->status === $key)>{{ $label }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn">Обновить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div style="margin-top: 12px;">{{ $bookings->links() }}</div>
    @else
        <p class="muted">Заявок пока нет.</p>
    @endif
</div>
@endsection
