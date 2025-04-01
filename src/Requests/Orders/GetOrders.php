<?php

declare(strict_types=1);

namespace TokTokDev\PrintAPI\Requests\Orders;

use JsonException;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;
use TokTokDev\PrintAPI\DataTransferObjects\Order\OrderSummaryDto;

final class GetOrders extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function __construct() {}

    public function resolveEndpoint(): string
    {
        return '/orders';
    }

    /**
     * @throws JsonException
     */
    public function createDtoFromResponse(Response $response): array
    {
        return array_map(function (array $row) {
            return OrderSummaryDto::fromArray($row);
        }, $response->json('results'));
    }
}
