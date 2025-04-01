<?php

declare(strict_types=1);

namespace TokTokDev\PrintAPI\DataTransferObjects\Order;

final readonly class OrderItemDto
{
    public function __construct(
        public string $id,
        public string $productId,
        public int $quantity,
        public ?int $pageCount = null,
        public ?OrderItemFilesDto $files = null,
        public ?string $metadata = null,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            id: $data['id'],
            productId: $data['productId'],
            quantity: $data['quantity'],
            pageCount: $data['pageCount'] ?? null,
            files: isset($data['files']) ? OrderItemFilesDto::fromResponse($data['files']) : null,
            metadata: $data['metadata'] ?? null,
        );
    }
}
