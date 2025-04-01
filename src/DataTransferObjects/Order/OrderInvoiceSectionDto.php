<?php

declare(strict_types=1);

namespace TokTokDev\PrintAPI\DataTransferObjects\Order;

final readonly class OrderInvoiceSectionDto
{
    public function __construct(
        public float $cost,
        public array $taxes,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            cost: $data['cost'],
            taxes: array_map(fn (array $tax) => OrderInvoiceTaxDto::fromResponse($tax), $data['taxes']),
        );
    }
}
