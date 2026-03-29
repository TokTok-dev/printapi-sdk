<?php

declare(strict_types=1);

namespace TokTokDev\PrintAPI\Resources;

use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\BaseResource;
use Throwable;
use TokTokDev\PrintAPI\DataTransferObjects\Shipping\ShippingQuoteBodyDto;
use TokTokDev\PrintAPI\DataTransferObjects\Shipping\ShippingQuoteDto;
use TokTokDev\PrintAPI\PrintApi;
use TokTokDev\PrintAPI\Requests\Shipping\GetQuote;

/**
 * @property PrintApi $connector
 */
final class Shipping extends BaseResource
{
    /**
     * @throws FatalRequestException
     * @throws Throwable
     * @throws RequestException
     */
    public function getQuote(ShippingQuoteBodyDto $quoteBodyDto): ShippingQuoteDto
    {
        return $this->connector
            ->send(new GetQuote($quoteBodyDto))
            ->throw()
            ->dtoOrFail();

    }
}
