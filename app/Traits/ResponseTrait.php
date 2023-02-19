<?php

namespace App\Traits;

use App\Enums\TokenTypeEnum;
use App\Enums\RouteNameEnum;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

/**
 *
 */
trait ResponseTrait
{

    /**
     * @var
     */
    private $data;

    /**
     * @var string
     */
    private string $message;

    /**
     * @var string
     */
    private string $info_message;


    /**
     * @var int
     */
    private int $status;

    /**
     * @param $data
     * @return $this
     */
    public function success($data = null): static
    {
        $this->data = $data;
        $this->status = 200;
        $this->info_message = "Başarılı";

        return $this;
    }


    /**
     * @param $data
     * @return $this
     */
    public function fail($data = null): static
    {
        $this->data = $data;
        $this->status = 404;
        $this->info_message = "Başarısız";

        return $this;
    }


    /**
     * @param string|null $message
     * @return $this
     */
    public function mes(string $message = null): static
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @param $message
     * @return $this
     */
    public function failMes($message = null): static
    {
        $this->message = $message;
        $this->status = 404;
        $this->info_message = "Başarısız";

        return $this;
    }

    /**
     * @param int|null $status
     * @return JsonResponse
     */
    public function send(int $status = null): JsonResponse
    {
        $this->status = $status ?? $this->status;

        $bearer = Cache::get(TokenTypeEnum::BEARER->value);
        $refresh = Cache::get(TokenTypeEnum::REFRESH->value);

        Cache::put(TokenTypeEnum::BEARER->value, null);
        Cache::put(TokenTypeEnum::REFRESH->value, null);

        return response()->json([
            "info" => RouteNameEnum::generateInfoMes(request()->route()->getName()) . " " . $this->info_message,
            "message" => $this->message ?? null,
            "data" => $this->data ?? null,
        ], $this->status)->withHeaders([
            TokenTypeEnum::BEARER->value => $bearer,
            TokenTypeEnum::REFRESH->value => $refresh,
        ]);
    }
}
