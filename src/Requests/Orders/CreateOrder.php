<?php

declare(strict_types=1);

namespace TokTokDev\PrintAPI\Requests\Orders;

use JsonException;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;
use TokTokDev\PrintAPI\DataTransferObjects\Order\OrderDto;

final class CreateOrder extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(protected readonly array $data) {}

    public function resolveEndpoint(): string
    {
        return '/orders';
    }

    /**
     * @throws JsonException
     */
    public function createDtoFromResponse(Response $response): OrderDto
    {
        return OrderDto::fromResponse($response->json());
    }

    protected function defaultBody(): array
    {
        return $this->data;
    }

    protected function defaultHeaders(): array
    {
        return [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];
    }
}
