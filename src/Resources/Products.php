<?php

declare(strict_types=1);

namespace TokTokDev\PrintAPI\Resources;

use Illuminate\Support\LazyCollection;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\BaseResource;
use Throwable;
use TokTokDev\PrintAPI\DataTransferObjects\Product\ProductDto;
use TokTokDev\PrintAPI\Requests\Products\GetProduct;
use TokTokDev\PrintAPI\Requests\Products\GetProducts;

/**
 * @property \TokTokDev\PrintAPI\PrintApi $connector
 */
final class Products extends BaseResource
{
    public function all(): LazyCollection
    {
        return $this->connector
            ->paginate((new GetProducts()))
            ->collect();
    }

    /**
     * @throws FatalRequestException
     * @throws RequestException
     * @throws Throwable
     */
    public function get(string $id): ProductDto
    {
        return $this->connector
            ->send(new GetProduct($id))
            ->throw()
            ->dtoOrFail();

    }
}
