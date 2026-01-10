<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class ForceNgrokUrl
{
    public function handle(Request $request, Closure $next)
    {
        // Cambia questo con il tuo URL Ngrok corrente
        $ngrokUrl = env('NGROK_URL', 'https://rapt-sonia-regulable.ngrok-free.dev');

        // Forza Laravel a usare questo come base URL
        URL::forceRootUrl($ngrokUrl);

        // Se vuoi, forza HTTPS (Ngrok usa sempre HTTPS)
        URL::forceScheme('https');

        return $next($request);
    }
}

