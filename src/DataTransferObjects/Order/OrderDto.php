<?php

declare(strict_types=1);

namespace TokTokDev\PrintAPI\DataTransferObjects\Order;

use TokTokDev\PrintAPI\Enums\OrderStatus;

final readonly class OrderDto
{
    public function __construct(
        public string $id,
        public string $dateTime,
        public OrderStatus $status,
        public array $items,
        public OrderShippingDto $shipping,
        public ?string $email = null,
        public ?string $username = null,
        public ?string $productionSpeed = null,
        public ?string $metadata = null,
        public ?OrderInvoiceDto $invoice = null,
        public ?string $invoicingState = null,
        public ?string $trackingUrl = null,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            id: $data['id'],
            dateTime: $data['dateTime'],
            status: OrderStatus::from($data['status']),
            items: array_map(fn (array $item) => OrderItemDto::fromResponse($item), $data['items']),
            shipping: OrderShippingDto::fromResponse($data['shipping']),
            email: $data['email'] ?? null,
            username: $data['username'] ?? null,
            productionSpeed: $data['productionSpeed'] ?? null,
            metadata: $data['metadata'] ?? null,
            invoice: isset($data['invoice']) ? OrderInvoiceDto::fromResponse($data['invoice']) : null,
            invoicingState: $data['invoicingState'] ?? null,
            trackingUrl: $data['trackingUrl'] ?? null,
        );
    }
}
