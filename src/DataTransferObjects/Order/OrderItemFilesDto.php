<?php

declare(strict_types=1);

namespace TokTokDev\PrintAPI\DataTransferObjects\Order;

final readonly class OrderItemFilesDto
{
    public function __construct(
        public ?OrderItemFileDto $content = null,
        public ?OrderItemFileDto $cover = null,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            content: isset($data['content']) ? OrderItemFileDto::fromResponse($data['content']) : null,
            cover: isset($data['cover']) ? OrderItemFileDto::fromResponse($data['cover']) : null,
        );
    }
}
