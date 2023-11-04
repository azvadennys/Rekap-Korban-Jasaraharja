<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Telegram\Bot\Laravel\Facades\Telegram;

class CheckDomain
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $allowedDomains = ['127.0.0.1:8000', 'www.jasaraharja.sipadek-kanwil-bpn-bengkulu.my.id', 'jasaraharja.sipadek-kanwil-bpn-bengkulu.my.id']; // Daftar domain yang diperbolehkan
        $ipAddress = $request->ip();
        $userAgent = $request->userAgent();

        // Periksa apakah domain permintaan ada dalam daftar yang diperbolehkan
        if (!in_array($request->getHttpHost(), $allowedDomains)) {
            $secretCode = 'azvadenTech'; // Ganti dengan secret code yang sesuai
            $message =
                '*⚠️⚠️Project: SI Jasaraharja⚠️⚠️*' . PHP_EOL .
                '_Website dalam mode Maintenance karena domain tidak sesuai_' . PHP_EOL .
                'Domain yang diminta: ' . request()->getHttpHost() . PHP_EOL .
                'Domain yang diizinkan: ' . implode(', ', $allowedDomains) . PHP_EOL .
                'IP Address: ' . $ipAddress . PHP_EOL .
                'Secret Code: ' . $secretCode . PHP_EOL . PHP_EOL .

                'User Agent: ' . PHP_EOL  . $userAgent;
            $chat_id = '5163645049'; // Ganti dengan ID chat yang sesuai

            Telegram::sendMessage([
                'chat_id' => $chat_id,
                'text' => $message,
                'parse_mode' => 'Markdown',
            ]);

            Artisan::call("down --secret={$secretCode}");
        }

        return $next($request);
    }
}
