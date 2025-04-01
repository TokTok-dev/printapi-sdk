<?php

declare(strict_types=1);

namespace TokTokDev\PrintAPI\Requests\Orders;

use DateTimeImmutable;
use Illuminate\Support\Collection;
use JsonException;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use TokTokDev\PrintAPI\DataTransferObjects\Order\OrderStatusUpdateDto;

final class GetOrderStatuses extends Request
{
    protected Method $method = Method::GET;

    public function __construct(protected readonly DateTimeImmutable $since) {}

    public function resolveEndpoint(): string
    {
        return '/sync/statuses?since='.$this->since->format('Y-m-d\TH:i:s');
    }

    /**
     * @throws JsonException
     */
    public function createDtoFromResponse(Response $response): Collection
    {
        return $response->collect('results')->map(fn ($row) => OrderStatusUpdateDto::fromResponse($row));
    }
}
