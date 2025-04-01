<?php

declare(strict_types=1);

namespace TokTokDev\PrintAPI\Factories;

use TokTokDev\PrintAPI\DataTransferObjects\Product\ProductSummaryDto;

final class ProductSummaryFactory
{
    public static function fromArray(array $data): ProductSummaryDto
    {
        return new ProductSummaryDto(
            id: $data['id'],
            name: $data['name'],
            url: $data['url'],
        );
    }
}
