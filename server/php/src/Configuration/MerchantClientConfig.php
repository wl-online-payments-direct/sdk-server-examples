<?php

namespace MyApp\Configuration;
use OnlinePayments\Sdk\Client;
use OnlinePayments\Sdk\ClientInterface;
use OnlinePayments\Sdk\Communicator;
use OnlinePayments\Sdk\CommunicatorConfiguration;
use OnlinePayments\Sdk\DefaultConnection;
use OnlinePayments\Sdk\Merchant\MerchantClientInterface;

/**
 * Merchant client configuration class
 * Provides the client and the merchant client used as DI in where needed
 */
class MerchantClientConfig 
{
    const INTEGRATOR = "integrator";
    private $merchantId;
    private $apiKey;
    private $apiSecret;
    private $apiEndpoint;

    public function __construct(string $merchantId, string $apiKey, string $apiSecret, string $apiEndpoint)
    {
        $this->merchantId = $merchantId;
        $this->apiKey = $apiKey;
        $this->apiSecret = $apiSecret;
        $this->apiEndpoint = $apiEndpoint;
    }

    public function getMerchantId(): string
    {
        return $this->merchantId;
    }

    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    public function getApiSecret(): string
    {
        return $this->apiSecret;
    }

    public function getApiEndpoint(): string
    {
        return $this->apiEndpoint;
    }

    public function communicatorConfiguration(): CommunicatorConfiguration 
    {
        return new CommunicatorConfiguration(
            $this->apiKey,
            $this->apiSecret,
            $this->apiEndpoint,
            MerchantClientConfig::INTEGRATOR
        );
    }

    public function client(CommunicatorConfiguration $communicatorConfiguration): ClientInterface
    {
        $connection = new DefaultConnection();
        $communicator = new Communicator($connection, $communicatorConfiguration);
        
        return new Client($communicator);
    }

    public function merchantClient($client): MerchantClientInterface {
        return $client->merchant($this->merchantId);
    }
}