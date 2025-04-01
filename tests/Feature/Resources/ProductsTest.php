<?php

declare(strict_types=1);

use TokTokDev\PrintAPI\DataTransferObjects\Product\ProductDto;
use TokTokDev\PrintAPI\DataTransferObjects\Product\ProductSummaryDto;

test('can retrieve all products', function () {
    $response = $this->printApi->products()->all();

    expect($response)->toBeInstanceOf(Illuminate\Support\LazyCollection::class)
        ->and($response->count())->toBe(499)
        ->and($response->first())->toBeInstanceOf(ProductSummaryDto::class);
});

test('can retrieve a product by id', function () {
    $response = $this->printApi->products()->get('boek_hc_a4_lig');

    expect($response)->toBeInstanceOf(ProductDto::class);
});
