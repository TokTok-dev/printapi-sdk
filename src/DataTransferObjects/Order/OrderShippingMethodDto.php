<?php

declare(strict_types=1);

namespace TokTokDev\PrintAPI\DataTransferObjects\Order;

final readonly class OrderShippingMethodDto
{
    public function __construct(
        public string $name,
        public bool $isTrackable,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            name: $data['name'],
            isTrackable: $data['isTrackable'],
        );
    }
}
