<?php

declare(strict_types=1);

namespace TokTokDev\PrintAPI\DataTransferObjects\Product;

final readonly class ProductFileDto
{
    /**
     * @param  string[]  $accepts
     */
    public function __construct(
        public string $id,
        public float $height,
        public float $width,
        public float $bleed,
        public array $accepts,
    ) {}
}
