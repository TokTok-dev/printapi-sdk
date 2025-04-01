<?php

declare(strict_types=1);

namespace TokTokDev\PrintAPI\DataTransferObjects\Product;

final readonly class ProductOptionDto
{
    /**
     * @param  OptionChoiceDto[]  $choices
     */
    public function __construct(
        public string $id,
        public string $default,
        public string $label,
        public array $choices,
    ) {}
}
