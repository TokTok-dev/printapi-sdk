<?php

declare(strict_types=1);

namespace TokTokDev\PrintAPI\DataTransferObjects\Order;

final readonly class OrderInvoiceDto
{
    public function __construct(
        public OrderInvoiceSectionDto $production,
        public OrderInvoiceSectionDto $shipping,
        public OrderInvoiceSectionDto $handling,
        public OrderInvoiceSectionDto $total,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            production: OrderInvoiceSectionDto::fromResponse($data['production']),
            shipping: OrderInvoiceSectionDto::fromResponse($data['shipping']),
            handling: OrderInvoiceSectionDto::fromResponse($data['handling']),
            total: OrderInvoiceSectionDto::fromResponse($data['total']),
        );
    }
}
