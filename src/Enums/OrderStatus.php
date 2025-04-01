<?php

declare(strict_types=1);

namespace TokTokDev\PrintAPI\Enums;

enum OrderStatus: string
{
    case Created = 'Created';
    case Processing = 'Processing';
    case Shipped = 'Shipped';
    case Cancelled = 'Cancelled';
}
