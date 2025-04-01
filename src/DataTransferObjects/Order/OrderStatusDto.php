<?php

declare(strict_types=1);

namespace TokTokDev\PrintAPI\DataTransferObjects\Order;

use TokTokDev\PrintAPI\Enums\OrderStatus;
use TokTokDev\PrintAPI\Enums\PaymentStatus;

final readonly class OrderStatusDto
{
    public function __construct(
        public OrderStatus $order,
        public ?PaymentStatus $payment = null,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            order: OrderStatus::from($data['order']),
            payment: isset($data['payment']) ? PaymentStatus::from($data['payment']) : null,
        );
    }
}
