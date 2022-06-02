<?php

namespace App\Http\Services;

use Exception;
use Illuminate\Support\Facades\Http;

class BitlyService
{
    public static function shorten($url)
    {
        try {
            $request = Http::withToken(env('BITLY_API_KEY'))
                ->post(env('BITLY_BASE_URL') . '/shorten', [
                    'long_url' => $url,
                ]);

            logger()->info($url);
            logger()->info(config('app.url'));
            logger()->info($request->json());

            return $request->json()['link'];
        } catch (Exception $exception) {
            report($exception);
        }

        return '';
    }
}
