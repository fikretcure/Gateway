<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Cache;

/**
 *
 */
class UserHelper
{
    /**
     * @param $bearer
     * @param $refresh
     * @return void
     */
    public function setCacheToken($bearer, $refresh): void
    {
        Cache::put("bearer", $bearer);
        Cache::put("refresh", $refresh);
    }

    /**
     * @return void
     */
    public function clearCacheToken(): void
    {
        Cache::put("bearer", null);
        Cache::put("refresh", null);
    }

}
