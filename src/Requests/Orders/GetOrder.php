<?php

declare(strict_types=1);

namespace TokTokDev\PrintAPI\Requests\Orders;

use JsonException;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use TokTokDev\PrintAPI\DataTransferObjects\Order\OrderDto;

final class GetOrder extends Request
{
    protected Method $method = Method::GET;

    public function __construct(protected readonly string $id) {}

    public function resolveEndpoint(): string
    {
        return '/orders/'.$this->id;
    }

    /**
     * @throws JsonException
     */
    public function createDtoFromResponse(Response $response): OrderDto
    {
        return OrderDto::fromResponse($response->json());
    }
}
