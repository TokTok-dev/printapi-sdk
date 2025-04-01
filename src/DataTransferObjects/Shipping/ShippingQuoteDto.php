<?php

declare(strict_types=1);

namespace TokTokDev\PrintAPI\DataTransferObjects\Shipping;

final readonly class ShippingQuoteDto
{
    public function __construct(
        public float $shipping,
        public float $handling,
        public float $taxRate,
        public float $payment,
        public ShippingMethodDto $method,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            shipping: $data['shipping'],
            handling: $data['handling'],
            taxRate: $data['taxRate'],
            payment: $data['payment'],
            method: ShippingMethodDto::fromResponse($data['method']),
        );
    }
}
