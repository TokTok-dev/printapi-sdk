<?php

declare(strict_types=1);

namespace TokTokDev\PrintAPI\Resources;

use DateTimeImmutable;
use Illuminate\Support\LazyCollection;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\BaseResource;
use Throwable;
use TokTokDev\PrintAPI\DataTransferObjects\Order\OrderDto;
use TokTokDev\PrintAPI\DataTransferObjects\Order\OrderStatusDto;
use TokTokDev\PrintAPI\Requests\Orders\CreateOrder;
use TokTokDev\PrintAPI\Requests\Orders\GetOrder;
use TokTokDev\PrintAPI\Requests\Orders\GetOrders;
use TokTokDev\PrintAPI\Requests\Orders\GetOrderStatus;
use TokTokDev\PrintAPI\Requests\Orders\GetOrderStatuses;

/**
 * @property \TokTokDev\PrintAPI\PrintApi $connector
 */
final class Orders extends BaseResource
{
    /**
     * @throws FatalRequestException
     * @throws RequestException
     * @throws Throwable
     */
    public function create(array $data): OrderDto
    {
        return $this->connector
            ->send(new CreateOrder($data))
            ->throw()
            ->dtoOrFail();
    }

    /**
     * @throws Throwable
     */
    public function all(): LazyCollection
    {
        return $this->connector
            ->paginate(new GetOrders())
            ->collect();
    }

    /**
     * @throws Throwable
     */
    public function get(string $id): OrderDto
    {
        return $this->connector
            ->send(new GetOrder($id))
            ->throw()
            ->dtoOrFail();
    }

    /**
     * @throws \Saloon\Exceptions\Request\FatalRequestException
     * @throws Throwable
     * @throws \Saloon\Exceptions\Request\RequestException
     */
    public function status(string $id): OrderStatusDto
    {
        return $this->connector
            ->send(new GetOrderStatus($id))
            ->throw()
            ->dtoOrFail();
    }

    /**
     * @throws \Saloon\Exceptions\Request\FatalRequestException
     * @throws Throwable
     * @throws \Saloon\Exceptions\Request\RequestException
     */
    public function syncStatuses(DateTimeImmutable $since)
    {
        return $this->connector
            ->send(new GetOrderStatuses($since))
            ->throw()
            ->dtoOrFail();
    }
}
