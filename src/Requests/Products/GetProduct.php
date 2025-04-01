<?php

declare(strict_types=1);

namespace TokTokDev\PrintAPI\Requests\Products;

use JsonException;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use TokTokDev\PrintAPI\DataTransferObjects\Product\ProductDto;
use TokTokDev\PrintAPI\Factories\ProductFactory;

final class GetProduct extends Request
{
    protected Method $method = Method::GET;

    public function __construct(protected readonly string $productId) {}

    public function resolveEndpoint(): string
    {
        return '/products/'.$this->productId;
    }

    /**
     * @throws JsonException
     */
    public function createDtoFromResponse(Response $response): ProductDto
    {
        return ProductFactory::fromArray($response->json());
    }
}
