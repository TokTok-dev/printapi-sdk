<?php

declare(strict_types=1);

namespace TokTokDev\PrintAPI\Requests\Orders;

use JsonException;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use TokTokDev\PrintAPI\DataTransferObjects\Order\OrderStatusDto;

final class GetOrderStatus extends Request
{
    protected Method $method = Method::GET;

    public function __construct(protected readonly string $id) {}

    public function resolveEndpoint(): string
    {
        return '/orders/'.$this->id.'/status';
    }

    /**
     * @throws JsonException
     */
    public function createDtoFromResponse(Response $response): OrderStatusDto
    {
        return OrderStatusDto::fromResponse($response->json());
    }
}
