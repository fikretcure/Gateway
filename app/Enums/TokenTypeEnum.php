<?php

namespace App\Enums;

/**
 *
 */
enum TokenTypeEnum: string
{
    case BEARER = "bearer";
    case REFRESH = "refresh";
}
