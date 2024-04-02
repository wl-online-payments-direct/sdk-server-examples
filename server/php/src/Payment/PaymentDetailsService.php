<?php

namespace MyApp\Payment;
use OnlinePayments\Sdk\Domain\PaymentDetailsResponse;
use OnlinePayments\Sdk\Merchant\MerchantClientInterface;

/**
 * Payment details service
 */
class PaymentDetailsService
{
    private $merchantClient;

    public function __construct(MerchantClientInterface $merchantClient) {
        $this->merchantClient = $merchantClient;
    }

    public function getPaymentDetails(string $paymentId): PaymentDetailsResponse {
        return $this->merchantClient->payments()->getPaymentDetails($paymentId);
    }

    public function getPaymentDetailsForHostedCheckout(string $hostedCheckoutId): PaymentDetailsResponse {
        $paymentId = sprintf("%s_0", $hostedCheckoutId);
        return $this->merchantClient->payments()->getPaymentDetails($paymentId);
    }
}