<?php

declare(strict_types=1);

namespace TokTokDev\PrintAPI\DataTransferObjects\Order;

final readonly class OrderInvoiceTaxDto
{
    public function __construct(
        public float $rate,
        public float $amount,
        public ?float $calculatedOver = null,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            rate: $data['rate'],
            amount: $data['amount'],
            calculatedOver: $data['calculatedOver'] ?? null,
        );
    }
}
