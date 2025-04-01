<?php

declare(strict_types=1);

namespace TokTokDev\PrintAPI\DataTransferObjects\Product;

final readonly class ProductDto
{
    /**
     * @param  ProductOptionDto[]  $options
     * @param  ProductFileDto[]  $files
     * @param  ProductionTimeDto[]  $productionTimes
     *
     * TODO: Support quantity discounts
     */
    public function __construct(
        public string $id,
        public string $name,
        public string $category,
        public float $taxRate,
        public PriceDto $cost,
        public ?PriceDto $checkout,
        public int $minQuantity,
        public int $maxQuantity,
        public bool $hasVariablePageCount,
        public ?int $fixedPageCount,
        public ?int $minPageCount,
        public ?int $maxPageCount,
        public ?int $pageCountIncrement,
        public ?float $paperThickness,
        public array $options,
        public array $files,
        public array $productionTimes,
    ) {}
}
