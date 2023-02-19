<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;
use Throwable;

/**
 *
 */
trait SenRequestTrait
{
    /**
     * @param $url
     * @param $method
     * @return string
     * @throws Throwable
     */
    public function sendRequest($url, $method = null, $data = null): mixed
    {
        $method = $method ?? "get";
        $response = Http::withHeaders([
            'API-CONNECTION-KEY' => env("API_CONNECTION_KEY"),
            "Accept" => "application/json"
        ])->$method("http://" . $url, $data);

        throw_if($response->failed(), \Exception::class, $response->json());
        return $response->collect();
    }
}
