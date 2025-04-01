<?php

declare(strict_types=1);

namespace TokTokDev\PrintAPI\Factories;

use TokTokDev\PrintAPI\DataTransferObjects\Product\OptionChoiceDto;
use TokTokDev\PrintAPI\DataTransferObjects\Product\PriceDto;
use TokTokDev\PrintAPI\DataTransferObjects\Product\ProductDto;
use TokTokDev\PrintAPI\DataTransferObjects\Product\ProductFileDto;
use TokTokDev\PrintAPI\DataTransferObjects\Product\ProductionTimeDto;
use TokTokDev\PrintAPI\DataTransferObjects\Product\ProductOptionDto;

final class ProductFactory
{
    public static function fromArray(array $data): ProductDto
    {
        return new ProductDto(
            id: $data['id'],
            name: $data['name'],
            category: $data['category'],
            taxRate: $data['taxRate'],
            cost: new PriceDto($data['cost']['base'], $data['cost']['perExtraPage']),
            checkout: isset($data['checkout']) ? new PriceDto($data['checkout']['base'], $data['checkout']['perExtraPage']) : null,
            minQuantity: $data['minQuantity'],
            maxQuantity: $data['maxQuantity'],
            hasVariablePageCount: $data['hasVariablePageCount'],
            fixedPageCount: $data['fixedPageCount'] ?? null,
            minPageCount: $data['minPageCount'] ?? null,
            maxPageCount: $data['maxPageCount'] ?? null,
            pageCountIncrement: $data['pageCountIncrement'] ?? null,
            paperThickness: $data['paperThickness'] ?? null,
            options: array_map(
                fn (array $option) => new ProductOptionDto(
                    $option['id'],
                    $option['default'],
                    $option['label'],
                    array_map(
                        fn (array $choice) => new OptionChoiceDto(
                            $choice['value'],
                            $choice['name'],
                            new PriceDto($choice['cost']['base'], $choice['cost']['perExtraPage']),
                            isset($choice['checkout']) ? new PriceDto($choice['checkout']['base'], $choice['checkout']['perExtraPage']) : null,
                        ),
                        $option['choices']
                    ),
                ),
                $data['options']
            ),
            files: array_map(
                fn (array $file) => new ProductFileDto(
                    $file['id'],
                    $file['height'],
                    $file['width'],
                    $file['bleed'],
                    $file['accepts'],
                ),
                $data['files']
            ),
            productionTimes: array_map(
                fn (array $time) => new ProductionTimeDto(
                    $time['speed'],
                    $time['days'],
                    $time['limitHour'],
                ),
                $data['productionTimes']
            )
        );
    }
}
