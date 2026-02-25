<?php

namespace OnlinePayments\ExampleApp\Application\Interfaces\SDKClients;

use OnlinePayments\ExampleApp\Application\DTOs\Payment\RequestDto;
use OnlinePayments\ExampleApp\Application\DTOs\Payment\ResponseDto;
use OnlinePayments\ExampleApp\Application\DTOs\AdditionalPaymentActions\RequestDto as AdditionalPaymentActionsRequestDto;
use OnlinePayments\ExampleApp\Application\DTOs\AdditionalPaymentActions\ResponseDto as AdditionalPaymentActionsResponseDto;
use OnlinePayments\ExampleApp\Application\DTOs\GetPaymentDetails\ResponseDto as GetPaymentDetailsResponseDto;

interface PaymentClientInterface
{
    public function createPayment(RequestDto $requestDto): ResponseDto;
    public function getPaymentDetailsById(string $id): ?GetPaymentDetailsResponseDto;
    public function cancelPayment(AdditionalPaymentActionsRequestDto $requestDto): AdditionalPaymentActionsResponseDto;
    public function capturePayment(AdditionalPaymentActionsRequestDto $requestDto): AdditionalPaymentActionsResponseDto;
    public function refundPayment(AdditionalPaymentActionsRequestDto $requestDto): AdditionalPaymentActionsResponseDto;
}
