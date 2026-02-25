<?php

namespace OnlinePayments\ExampleApp\Application\Handlers;

use OnlinePayments\ExampleApp\Application\Domain\Enums\Payments\PaymentMethodType;
use OnlinePayments\ExampleApp\Application\DTOs\Payment\RequestDto;
use OnlinePayments\ExampleApp\Application\DTOs\Payment\ResponseDto;
use OnlinePayments\ExampleApp\Application\Interfaces\Handlers\PaymentMethodHandlerInterface;
use OnlinePayments\ExampleApp\Application\Interfaces\SDKClients\MandateClientInterface;
use OnlinePayments\ExampleApp\Application\Interfaces\SDKClients\PaymentClientInterface;

final readonly class DirectDebitPaymentHandler implements PaymentMethodHandlerInterface
{
    private const DIRECT_DEBIT_PRODUCT_ID = 771;

    public function __construct(
        private PaymentClientInterface $paymentClient,
        private MandateClientInterface $mandateClient
    )
    {
    }

    public function getSupportedMethod(): PaymentMethodType
    {
        return PaymentMethodType::DIRECT_DEBIT;
    }

    public function handle(RequestDto $requestDto): ResponseDto
    {
        $existingMandate = null;

        $mandateReference = $requestDto->mandate?->mandateReference ?? null;
        if (!empty($mandateReference)) {
            $existingMandate = $this->mandateClient->getMandate($mandateReference);
        }

        if ($existingMandate === null) {
            $newMandate = $this->mandateClient->createMandate($requestDto);

            $requestDto->mandate = $newMandate;
        } elseif ($requestDto->mandate !== null) {
            $requestDto->mandate->mandateReference = $existingMandate->mandateReference ?? null;
        }

        $requestDto->paymentProductId = self::DIRECT_DEBIT_PRODUCT_ID;

        return $this->paymentClient->createPayment($requestDto);
    }
}