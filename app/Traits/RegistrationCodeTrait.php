<?php

namespace App\Traits;

use App\Models\User;

/**
 *
 */
trait RegistrationCodeTrait
{
    /**
     * @return array
     */
    public function createRegistrationCode($model)
    {
        $last_id = $model::query()->withTrashed()->max("id") + 1;
        return ["registration_code" => $model::$registration_code . str_repeat("0", (4 - strlen($last_id))) . $last_id];
    }
}
