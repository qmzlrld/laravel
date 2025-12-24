<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Бронирование столиков</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #0f172a;
            --card: #111827;
            --accent: #f97316;
            --muted: #cbd5e1;
            --border: #1f2937;
            --success: #22c55e;
            --danger: #ef4444;
            --info: #38bdf8;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: 'Montserrat', sans-serif;
            background: radial-gradient(circle at 10% 20%, #1e293b, #0f172a 45%), radial-gradient(circle at 80% 0%, #0ea5e9, transparent 30%), #0f172a;
            color: #e2e8f0;
            min-height: 100vh;
        }
        a { color: inherit; text-decoration: none; }
        header {
            position: sticky;
            top: 0;
            z-index: 10;
            background: rgba(15, 23, 42, 0.9);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border);
        }
        .nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            max-width: 1100px;
            margin: 0 auto;
            padding: 14px 20px;
        }
        .brand { font-weight: 700; letter-spacing: 0.02em; display: flex; gap: 10px; align-items: center; }
        .brand span { color: var(--accent); }
        .nav-links { display: flex; gap: 14px; align-items: center; }
        .btn {
            border: 1px solid var(--border);
            padding: 10px 14px;
            border-radius: 10px;
            background: linear-gradient(120deg, rgba(249, 115, 22, 0.12), rgba(14, 165, 233, 0.12));
            color: #e2e8f0;
            transition: transform 0.15s ease, border-color 0.15s ease, background 0.15s ease;
        }
        .btn:hover { transform: translateY(-1px); border-color: var(--accent); }
        .btn.accent { background: linear-gradient(135deg, #f97316, #fb923c); color: #0f172a; border-color: transparent; font-weight: 700; }
        .container { max-width: 1100px; margin: 0 auto; padding: 24px 20px 48px; }
        .card {
            background: rgba(17, 24, 39, 0.9);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 22px;
            box-shadow: 0 18px 38px rgba(0,0,0,0.35);
        }
        .card + .card { margin-top: 18px; }
        h1, h2, h3 { margin: 0 0 14px; letter-spacing: 0.01em; }
        .grid { display: grid; gap: 18px; }
        .grid.two { grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); }
        label { display: block; margin-bottom: 6px; color: var(--muted); font-size: 14px; }
        input, select, textarea {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            border: 1px solid var(--border);
            background: #0b1220;
            color: #e2e8f0;
            font-size: 14px;
        }
        textarea { min-height: 100px; resize: vertical; }
        .actions { display: flex; gap: 10px; align-items: center; flex-wrap: wrap; }
        .pill { padding: 6px 10px; border-radius: 999px; font-size: 12px; font-weight: 600; border: 1px solid var(--border); }
        .pill.new { background: rgba(56, 189, 248, 0.15); color: #38bdf8; }
        .pill.approved { background: rgba(34, 197, 94, 0.18); color: #22c55e; }
        .pill.cancelled { background: rgba(239, 68, 68, 0.15); color: #f87171; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px 12px; text-align: left; border-bottom: 1px solid var(--border); }
        th { color: var(--muted); font-weight: 600; }
        tr:hover td { background: rgba(255, 255, 255, 0.02); }
        .error { color: var(--danger); font-size: 13px; margin-top: 4px; }
        .flash { padding: 12px 14px; border-radius: 12px; margin-bottom: 14px; border: 1px solid var(--border); }
        .flash.success { background: rgba(34, 197, 94, 0.12); color: #bbf7d0; border-color: rgba(34, 197, 94, 0.35); }
        .flash.error { background: rgba(239, 68, 68, 0.1); color: #fecdd3; border-color: rgba(239, 68, 68, 0.35); }
        .flash.info { background: rgba(56, 189, 248, 0.1); color: #bae6fd; border-color: rgba(56, 189, 248, 0.35); }
        .muted { color: var(--muted); font-size: 14px; }
        .section-title { display: flex; align-items: center; justify-content: space-between; gap: 10px; }
        .tag { padding: 6px 10px; background: rgba(249, 115, 22, 0.16); border: 1px solid rgba(249, 115, 22, 0.5); border-radius: 10px; color: #fed7aa; font-size: 12px; }
        footer { text-align: center; color: var(--muted); font-size: 13px; padding: 26px 0; border-top: 1px solid var(--border); margin-top: 40px; }
        @media (max-width: 640px) {
            .nav { flex-direction: column; align-items: flex-start; gap: 10px; }
            header { position: static; }
        }
    </style>
</head>
<body>
<header>
    <div class="nav">
        <div class="brand">Table<span>Booking</span></div>
        <div class="nav-links">
            <a class="btn" href="{{ route('home') }}">Главная</a>
            @auth
                <a class="btn" href="{{ route('profile') }}">Профиль</a>
                @if(auth()->user()->is_admin)
                    <a class="btn" href="{{ route('admin.bookings.index') }}">Админ</a>
                @endif
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn">Выйти</button>
                </form>
            @endauth
            @guest
                <a class="btn" href="{{ route('login') }}">Войти</a>
                <a class="btn accent" href="{{ route('register') }}">Регистрация</a>
            @endguest
        </div>
    </div>
</header>
<main class="container">
    @if (session('success'))
        <div class="flash success">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="flash error">
            <ul style="margin:0; padding-left:16px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')
</main>
<footer>
    Сервис бронирования столиков · {{ date('Y') }}
</footer>
</body>
</html>
