<?php

declare(strict_types=1);

namespace TokTokDev\PrintAPI\DataTransferObjects\Shipping;

final readonly class ShippingMethodDto
{
    public function __construct(
        public string $name,
        public bool $isTrackable,
    ) {}

    public static function fromResponse(array $response): self
    {
        return new self(
            name: $response['name'],
            isTrackable: $response['isTrackable'],
        );
    }
}
