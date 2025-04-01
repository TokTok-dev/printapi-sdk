<?php

declare(strict_types=1);

namespace TokTokDev\PrintAPI\DataTransferObjects\Order;

final readonly class OrderShippingDto
{
    public function __construct(
        public OrderShippingAddressDto $address,
        public ?OrderShippingMethodDto $method = null,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            address: OrderShippingAddressDto::fromResponse($data['address']),
            method: isset($data['method']) ? OrderShippingMethodDto::fromResponse($data['method']) : null,
        );
    }
}
