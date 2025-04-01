<?php

declare(strict_types=1);

namespace TokTokDev\PrintAPI\Requests\Shipping;

use JsonException;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;
use TokTokDev\PrintAPI\DataTransferObjects\Shipping\ShippingQuoteBodyDto;
use TokTokDev\PrintAPI\DataTransferObjects\Shipping\ShippingQuoteDto;

final class GetQuote extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(protected readonly ShippingQuoteBodyDto $quoteBodyDto) {}

    public function resolveEndpoint(): string
    {
        return '/shipping/quote';
    }

    /**
     * @throws JsonException
     */
    public function createDtoFromResponse(Response $response): ShippingQuoteDto
    {
        return ShippingQuoteDto::fromResponse($response->json());
    }

    protected function defaultBody(): array
    {
        return $this->quoteBodyDto->all();
    }
}
