<?php

declare(strict_types=1);

use Illuminate\Support\Collection;
use TokTokDev\PrintAPI\DataTransferObjects\Order\OrderDto;
use TokTokDev\PrintAPI\DataTransferObjects\Order\OrderInvoiceDto;
use TokTokDev\PrintAPI\DataTransferObjects\Order\OrderItemDto;
use TokTokDev\PrintAPI\DataTransferObjects\Order\OrderShippingDto;
use TokTokDev\PrintAPI\DataTransferObjects\Order\OrderStatusDto;
use TokTokDev\PrintAPI\DataTransferObjects\Order\OrderStatusUpdateDto;
use TokTokDev\PrintAPI\DataTransferObjects\Order\OrderSummaryDto;
use TokTokDev\PrintAPI\Enums\OrderStatus;

test('can create an order', function () {
    $data = [
        'email' => 'info@printapi.nl',
        'productionSpeed' => 'Standard',
        'items' => [
            [
                'productId' => 'boek_hc_a5_sta',
                'pageCount' => 32,
                'quantity' => 1,
                'files' => [
                    'content' => 'https://www.printapi.nl/sample-book-a5-content.pdf',
                    'cover' => 'https://www.printapi.nl/sample-book-a5-cover.pdf',
                ],
            ],
        ],
        'shipping' => [
            'preference' => 'Tracked',
            'address' => [
                'name' => 'Print API',
                'line1' => 'Osloweg 75',
                'postCode' => '9700 GE',
                'city' => 'Groningen',
                'country' => 'NL',
            ],
        ],
    ];

    $response = $this->printApi->orders()->create($data);

    expect($response)->toBeInstanceOf(OrderDto::class)
        ->and($response->id)->toBe('11410410')
        ->and($response->status)->toBe(OrderStatus::Created)
        ->and($response->email)->toBe('info@printapi.nl')
        ->and($response->productionSpeed)->toBe('Standard')
        ->and($response->items)->toHaveCount(1)
        ->and($response->items[0])->toBeInstanceOf(OrderItemDto::class)
        ->and($response->items[0]->id)->toBe('01804')
        ->and($response->items[0]->productId)->toBe('boek_hc_a5_sta')
        ->and($response->items[0]->pageCount)->toBe(32)
        ->and($response->items[0]->quantity)->toBe(1)
        ->and($response->shipping)->toBeInstanceOf(OrderShippingDto::class)
        ->and($response->shipping->method->name)->toBe('Brievenbuspakje')
        ->and($response->shipping->method->isTrackable)->toBeTrue()
        ->and($response->shipping->address->name)->toBe('Print API')
        ->and($response->shipping->address->line1)->toBe('Osloweg 75')
        ->and($response->shipping->address->postCode)->toBe('9700 GE')
        ->and($response->shipping->address->city)->toBe('Groningen')
        ->and($response->shipping->address->country)->toBe('NL')
        ->and($response->invoice)->toBeInstanceOf(OrderInvoiceDto::class)
        ->and($response->invoice->production->cost)->toBe(10.69)
        ->and($response->invoice->shipping->cost)->toBe(2.95)
        ->and($response->invoice->handling->cost)->toBe(0.87)
        ->and($response->invoice->total->cost)->toBe(14.51)
        ->and($response->invoicingState)->toBe('Included');
});

test('can retrieve all orders', function () {
    $response = $this->printApi->orders()->all();

    expect($response)->toBeInstanceOf(Illuminate\Support\LazyCollection::class)
        ->and($response->count())->toBe(6)
        ->and($response->first())->toBeInstanceOf(OrderSummaryDto::class);
});

test('can get an order by id', function () {
    $response = $this->printApi->orders()->get('11410410');

    expect($response)->toBeInstanceOf(OrderDto::class)
        ->and($response->id)->toBe('11410410')
        ->and($response->status)->toBe(OrderStatus::Created)
        ->and($response->email)->toBe('info@printapi.nl');
});

test('can get an order status by id', function () {
    $response = $this->printApi->orders()->status('11410410');

    expect($response)->toBeInstanceOf(OrderStatusDto::class)
        ->and($response->order)->toBe(OrderStatus::Created);
});

test('can get order statuses since now', function () {
    $response = $this->printApi->orders()->syncStatuses(DateTimeImmutable::createFromFormat('Y-m-d H:i:s', '2025-03-24 13:00:00'));

    expect($response)->toBeInstanceOf(Collection::class)
        ->and($response->first())->toBeInstanceOf(OrderStatusUpdateDto::class);
});
