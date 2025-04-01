<?php

declare(strict_types=1);

namespace TokTokDev\PrintAPI\DataTransferObjects\Product;

final readonly class ProductSummaryDto
{
    public function __construct(
        public string $id,
        public string $name,
        public string $url,
    ) {}
}
