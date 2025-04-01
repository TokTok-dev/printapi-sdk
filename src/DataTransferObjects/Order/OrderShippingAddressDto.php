<?php

declare(strict_types=1);

namespace TokTokDev\PrintAPI\DataTransferObjects\Order;

final readonly class OrderShippingAddressDto
{
    public function __construct(
        public string $name,
        public string $line1,
        public ?string $line2,
        public string $postCode,
        public string $city,
        public string $country,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            name: $data['name'],
            line1: $data['line1'],
            line2: $data['line2'] ?? null,
            postCode: $data['postCode'],
            city: $data['city'],
            country: $data['country'],
        );
    }
}
