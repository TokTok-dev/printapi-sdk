<?php

declare(strict_types=1);

namespace TokTokDev\PrintAPI\DataTransferObjects\Shipping;

use TokTokDev\PrintAPI\Enums\Country;
use TokTokDev\PrintAPI\Enums\ShippingPreference;

final readonly class ShippingQuoteBodyDto
{
    /**
     * @param  array<int, ShipmentItemDto>  $items
     */
    public function __construct(
        public Country $country,
        public ShippingPreference $preference = ShippingPreference::Auto,
        public ?string $state = null,
        public array $items = [],
    ) {}

    public function all()
    {
        return array_filter([
            'country' => $this->country,
            'preference' => $this->preference,
            'state' => $this->state ?? null,
            'items' => $this->items,
        ]);
    }
}
