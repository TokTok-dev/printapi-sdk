<?php

declare(strict_types=1);

namespace TokTokDev\PrintAPI\Resources;

use Saloon\Http\BaseResource;
use Throwable;
use TokTokDev\PrintAPI\DataTransferObjects\Shipping\ShippingQuoteBodyDto;
use TokTokDev\PrintAPI\DataTransferObjects\Shipping\ShippingQuoteDto;
use TokTokDev\PrintAPI\Requests\Shipping\GetQuote;

/**
 * @property \TokTokDev\PrintAPI\PrintApi $connector
 */
final class Shipping extends BaseResource
{
    /**
     * @throws \Saloon\Exceptions\Request\FatalRequestException
     * @throws Throwable
     * @throws \Saloon\Exceptions\Request\RequestException
     */
    public function getQuote(ShippingQuoteBodyDto $quoteBodyDto): ShippingQuoteDto
    {
        return $this->connector
            ->send(new GetQuote($quoteBodyDto))
            ->throw()
            ->dtoOrFail();

    }
}
