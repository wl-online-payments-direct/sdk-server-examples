<?php

namespace MyApp\HostedTokenization;
use OnlinePayments\Sdk\Domain\CreateHostedTokenizationRequest;
use OnlinePayments\Sdk\Domain\CreateHostedTokenizationResponse;
use OnlinePayments\Sdk\Merchant\MerchantClientInterface;

/**
 * Hosted tokenization service
 */
class HostedTokenizationService
{
    private $merchantClient;

    public function __construct(MerchantClientInterface $merchantClient) {
        $this->merchantClient = $merchantClient;
    }

    public function initHostedTokenization(): CreateHostedTokenizationResponse {
        $hostedTokenizationResponse = $this->merchantClient->hostedTokenization()->createHostedTokenization(new CreateHostedTokenizationRequest());
        return $hostedTokenizationResponse;
    }
}