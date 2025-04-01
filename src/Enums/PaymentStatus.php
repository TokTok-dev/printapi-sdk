<?php

declare(strict_types=1);

namespace TokTokDev\PrintAPI\Enums;

enum PaymentStatus: string
{
    case Open = 'Open';
    case Failed = 'Failed';
    case Successful = 'Successful';
    case Cancelled = 'Cancelled';
}
