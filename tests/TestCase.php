<?php

declare(strict_types=1);

namespace TokTokDev\PrintAPI\Tests;

use Dotenv\Dotenv;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\PendingRequest;
use TokTokDev\PrintAPI\PrintApi;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    protected string $token;

    protected PrintApi $printApi;

    protected function setUp(): void
    {
        parent::setUp();

        $dotenv = Dotenv::createImmutable(__DIR__.'/..');
        $dotenv->load();

        $this->printApi = new PrintApi($_ENV['PRINTAPI_CLIENT_ID'], $_ENV['PRINTAPI_CLIENT_SECRET'], true);

        $mockClient = $this->getMockClient();
        $this->printApi->withMockClient($mockClient);

        $authenticator = $this->printApi->getAccessToken();
        $this->printApi->authenticate($authenticator);
    }

    private function getMockClient(): MockClient
    {
        return new MockClient([
            '*' => function (PendingRequest $pendingRequest) {
                $endpoint = $pendingRequest->getRequest()->resolveEndpoint();
                $method = $pendingRequest->getMethod()->value;
                $query = $pendingRequest->getUri()->getQuery();

                $filename = $query ? $method.'?'.$query : $method;

                return MockResponse::fixture(implode('/', [$endpoint, $filename]));
            },
        ]);
    }
}
