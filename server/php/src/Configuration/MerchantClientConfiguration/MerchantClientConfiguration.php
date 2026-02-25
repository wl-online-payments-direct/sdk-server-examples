<?php

namespace OnlinePayments\ExampleApp\Configuration\MerchantClientConfiguration;

use Dotenv\Dotenv;
use OnlinePayments\ExampleApp\Configuration\Exceptions\MissingCredentialsException;
use OnlinePayments\Sdk\Client as Client;
use OnlinePayments\Sdk\CommunicatorConfiguration;
use OnlinePayments\Sdk\Authentication\V1HmacAuthenticator;
use OnlinePayments\Sdk\Communicator;
use OnlinePayments\Sdk\Merchant\MerchantClient;

class MerchantClientConfiguration
{
    private string $merchantId;
    private string $apiKey;
    private string $apiSecret;
    private string $apiEndpoint;
    private string $integrator;
    private string $allowedOrigin;

    private Client $client;
    private MerchantClient $merchantClient;

    public function __construct(string $rootPath)
    {
        $dotenv = Dotenv::createImmutable($rootPath);
        $dotenv->load();

        $this->merchantId = getenv('MERCHANT_ID') ?: ($_ENV['MERCHANT_ID'] ?? '');
        $this->apiKey     = getenv('API_KEY') ?: ($_ENV['API_KEY'] ?? '');
        $this->apiSecret  = getenv('API_SECRET') ?: ($_ENV['API_SECRET'] ?? '');
        $this->apiEndpoint= getenv('API_ENDPOINT') ?: ($_ENV['API_ENDPOINT'] ?? '');
        $this->integrator = getenv('INTEGRATOR') ?: ($_ENV['INTEGRATOR'] ?? 'INTEGRATOR');
        $this->allowedOrigin = getenv('ALLOWED_ORIGIN') ?: ($_ENV['ALLOWED_ORIGIN'] ?? '');

        if (!$this->merchantId || !$this->apiKey || !$this->apiSecret || !$this->apiEndpoint || !$this->integrator || !$this->allowedOrigin) {
            throw new MissingCredentialsException("Missing required WL SDK credentials in environment.");
        }

        $this->createClient();
        $this->createMerchantClient();
    }

    private function createClient(): void
    {
        $communicatorConfig = new CommunicatorConfiguration(
            $this->apiKey,
            $this->apiSecret,
            $this->apiEndpoint,
            $this->integrator
        );

        $authenticator = new V1HmacAuthenticator($communicatorConfig);
        $communicator  = new Communicator($communicatorConfig, $authenticator);

        $this->client = new Client($communicator);
    }

    private function createMerchantClient(): void
    {
        $this->merchantClient = $this->client->merchant($this->merchantId);
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function getMerchantClient(): MerchantClient
    {
        return $this->merchantClient;
    }
}
