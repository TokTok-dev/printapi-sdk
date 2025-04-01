<?php

declare(strict_types=1);

namespace TokTokDev\PrintAPI\DataTransferObjects\Order;

use DateTimeImmutable;
use TokTokDev\PrintAPI\Enums\OrderStatus;

final readonly class OrderSummaryDto
{
    public function __construct(
        public string $id,
        public DateTimeImmutable $dateTime,
        public ?string $email = null,
        public ?string $username = null,
        public OrderStatus $status = OrderStatus::Created,
        public string $url = '',
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            dateTime: new DateTimeImmutable($data['dateTime']),
            email: $data['email'] ?? null,
            username: $data['username'] ?? null,
            status: OrderStatus::from($data['status']),
            url: $data['url'],
        );
    }
}
