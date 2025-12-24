<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'login' => ['required', 'string', 'min:6', 'regex:/^[A-Za-z0-9]+$/', 'unique:users,login'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'full_name' => ['required', 'string', 'regex:/^[А-ЯЁа-яё\s-]+$/u'],
            'phone' => ['required', 'regex:/^8\(\d{3}\)\d{3}-\d{2}-\d{2}$/'],
            'email' => ['required', 'string', 'email', 'unique:users,email'],
        ], [
            'login.regex' => 'Логин может содержать только латиницу и цифры.',
            'full_name.regex' => 'ФИО допускает только кириллицу и пробелы.',
            'phone.regex' => 'Телефон должен быть в формате 8(XXX)XXX-XX-XX.',
        ]);

        $user = User::create([
            'login' => $validated['login'],
            'full_name' => $validated['full_name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('profile')->with('success', 'Профиль создан. Добро пожаловать!');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt(['login' => $credentials['login'], 'password' => $credentials['password']], $request->boolean('remember'))) {
            return back()
                ->withErrors(['login' => 'Неверный логин или пароль.'])
                ->withInput();
        }

        $request->session()->regenerate();

        return redirect()->intended(route('profile'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Вы вышли из системы.');
    }
}
