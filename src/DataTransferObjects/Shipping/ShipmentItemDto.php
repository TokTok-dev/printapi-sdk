<?php

declare(strict_types=1);

namespace TokTokDev\PrintAPI\DataTransferObjects\Shipping;

final readonly class ShipmentItemDto
{
    public function __construct(
        public string $productId,
        public int $quantity,
        public ?int $pageCount = null,
    ) {}
}
