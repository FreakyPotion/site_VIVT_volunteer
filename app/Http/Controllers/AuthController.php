<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // Выполнить вход
    public function login(Request $request)
    {
        // Валидация данных
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Дополнительная проверка в базе данных
        $user = User::where('E-Mail', $request->email)
                    ->where('Пароль', $request->password)
                    ->first(); // Берем первого найденного

        // Если пользователь найден и пароль совпадает
        if ($user) {
            Auth::login($user); // Логиним пользователя
            return redirect()->intended('/'); // Перенаправление на защищенную страницу
        }

        // Если аутентификация не прошла
        return back()->withErrors([
            'email' => 'Неверные данные для входа или ваш аккаунт не активен.',
        ]);
    }

    // Выйти из системы
    public function logout()
    {
        Auth::logout();
        return redirect()->route('authorization');
    }
}
