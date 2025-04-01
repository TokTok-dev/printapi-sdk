<?php

declare(strict_types=1);

namespace TokTokDev\PrintAPI\DataTransferObjects\Product;

final readonly class OptionChoiceDto
{
    public function __construct(
        public string $value,
        public string $name,
        public PriceDto $cost,
        public ?PriceDto $checkout,
    ) {}
}
