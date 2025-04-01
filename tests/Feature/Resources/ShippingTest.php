<?php

declare(strict_types=1);

use TokTokDev\PrintAPI\DataTransferObjects\Shipping\ShipmentItemDto;
use TokTokDev\PrintAPI\DataTransferObjects\Shipping\ShippingQuoteBodyDto;
use TokTokDev\PrintAPI\DataTransferObjects\Shipping\ShippingQuoteDto;
use TokTokDev\PrintAPI\Enums\Country;
use TokTokDev\PrintAPI\Enums\ShippingPreference;

test('can retrieve a shipping quote', function () {
    $body = new ShippingQuoteBodyDto(
        country: Country::NL,
        preference: ShippingPreference::Tracked,
        state: null,
        items: [
            new ShipmentItemDto(
                productId: 'fotoprints_15x10',
                quantity: 1,
                pageCount: 10
            ),
        ]
    );

    $response = $this->printApi
        ->shipping()
        ->getQuote($body);

    expect($response)->toBeInstanceOf(ShippingQuoteDto::class);
});
