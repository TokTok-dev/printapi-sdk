<?php

declare(strict_types=1);

namespace TokTokDev\PrintAPI\Requests\Products;

use JsonException;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;
use TokTokDev\PrintAPI\Factories\ProductSummaryFactory;

final class GetProducts extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/products';
    }

    /**
     * @throws JsonException
     */
    public function createDtoFromResponse(Response $response): array
    {
        return array_map(function (array $row) {
            return ProductSummaryFactory::fromArray($row);
        }, $response->json('results'));
    }
}
