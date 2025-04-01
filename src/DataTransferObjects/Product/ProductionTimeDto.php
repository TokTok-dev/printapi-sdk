<?php

declare(strict_types=1);

namespace TokTokDev\PrintAPI\DataTransferObjects\Product;

final readonly class ProductionTimeDto
{
    public function __construct(
        public string $speed,
        public int $days,
        public int $limitHour,
    ) {}
}
