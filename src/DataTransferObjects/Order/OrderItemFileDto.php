<?php

declare(strict_types=1);

namespace TokTokDev\PrintAPI\DataTransferObjects\Order;

final readonly class OrderItemFileDto
{
    public function __construct(
        public string $status,
        public ?string $downloadUrl = null,
        public ?string $uploadUrl = null,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            status: $data['status'],
            downloadUrl: $data['downloadUrl'] ?? null,
            uploadUrl: $data['uploadUrl'] ?? null,
        );
    }
}
