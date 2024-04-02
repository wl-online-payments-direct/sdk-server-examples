<?php

namespace MyApp\HostedCheckout;
use OnlinePayments\Sdk\Domain\CreateHostedCheckoutRequest;
use OnlinePayments\Sdk\Domain\CreateHostedCheckoutResponse;
use OnlinePayments\Sdk\Merchant\MerchantClientInterface;

/**
 * Hosted checkout service
 */
class HostedCheckoutService
{
    private $merchantClient;

    public function __construct(MerchantClientInterface $merchantClient) {
        $this->merchantClient = $merchantClient;
    }

    public function createHostedCheckoutResponse(CreateHostedCheckoutRequest $createHostedCheckoutRequest): CreateHostedCheckoutResponse {
        $hostedCheckoutResponse = $this->merchantClient->hostedCheckout()->createHostedCheckout($createHostedCheckoutRequest);
        return $hostedCheckoutResponse;
    }
}