<?php

declare(strict_types=1);

namespace TokTokDev\PrintAPI\Enums;

enum ShippingPreference: string
{
    case Auto = 'Auto';
    case Tracked = 'Tracked';
}
