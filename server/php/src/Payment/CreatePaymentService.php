<?php

namespace MyApp\Payment;
use OnlinePayments\Sdk\Domain\CreatePaymentRequest;
use OnlinePayments\Sdk\Domain\CreatePaymentResponse;
use OnlinePayments\Sdk\Merchant\MerchantClientInterface;

/**
 * Create payment service
 */
class CreatePaymentService
{
    private $merchantClient;

    public function __construct(MerchantClientInterface $merchantClient) {
        $this->merchantClient = $merchantClient;
    }

    public function createPayment(CreatePaymentRequest $createPaymentRequest): CreatePaymentResponse {
        $createPaymentResponse = $this->merchantClient->payments()->createPayment($createPaymentRequest);
        return $createPaymentResponse;
    }
}