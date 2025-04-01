<?php

declare(strict_types=1);

namespace TokTokDev\PrintAPI\DataTransferObjects\Product;

final readonly class PriceDto
{
    public function __construct(
        public float $amount,
        public float $perExtraPage,
    ) {}
}
