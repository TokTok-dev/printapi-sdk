<?php

declare(strict_types=1);

namespace TokTokDev\PrintAPI;

use Saloon\Helpers\OAuth2\OAuthConfig;
use Saloon\Http\Connector;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\HasPagination;
use Saloon\PaginationPlugin\OffsetPaginator;
use Saloon\Traits\OAuth2\ClientCredentialsGrant;
use Saloon\Traits\Plugins\AcceptsJson;
use TokTokDev\PrintAPI\Resources\Orders;
use TokTokDev\PrintAPI\Resources\Products;
use TokTokDev\PrintAPI\Resources\Shipping;

final class PrintApi extends Connector implements HasPagination
{
    use AcceptsJson, ClientCredentialsGrant;

    public function __construct(
        private readonly string $clientId,
        private readonly string $clientSecret,
        private readonly bool $testMode = false
    ) {}

    public function resolveBaseUrl(): string
    {
        return 'https://'.($this->testMode ? 'test' : 'live').'.printapi.nl/v2';
    }

    public function products(): Products
    {
        return new Products($this);
    }

    public function shipping(): Shipping
    {
        return new Shipping($this);
    }

    public function orders(): Orders
    {
        return new Orders($this);
    }

    public function paginate(Request $request): OffsetPaginator
    {
        return new class(connector: $this, request: $request) extends OffsetPaginator
        {
            protected ?int $perPageLimit = 50;

            protected function isLastPage(Response $response): bool
            {
                return $this->getOffset() >= (int) $response->json('count');
            }

            protected function getPageItems(Response $response, Request $request): array
            {
                return $response->dto();
            }
        };
    }

    protected function defaultOauthConfig(): OAuthConfig
    {
        return OAuthConfig::make()
            ->setClientId($this->clientId)
            ->setClientSecret($this->clientSecret)
            ->setTokenEndpoint('/oauth');
    }

    protected function defaultHeaders(): array
    {
        return [
            'Accept' => 'application/json',
        ];
    }
}
