<?php

declare(strict_types=1);

namespace TokTokDev\PrintAPI\DataTransferObjects\Order;

use DateTimeImmutable;
use TokTokDev\PrintAPI\Enums\OrderStatus;

final readonly class OrderStatusUpdateDto
{
    public function __construct(
        public string $id,
        public OrderStatus $status,
        public DateTimeImmutable $dateTime,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            id: $data['id'],
            status: OrderStatus::from($data['status']),
            dateTime: new DateTimeImmutable($data['dateTime']),
        );
    }
}
