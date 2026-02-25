<?php

namespace OnlinePayments\ExampleApp\Application\Interfaces\Services;

use OnlinePayments\ExampleApp\Application\DTOs\AdditionalPaymentActions\RequestDto;
use OnlinePayments\ExampleApp\Application\DTOs\AdditionalPaymentActions\ResponseDto;
use OnlinePayments\ExampleApp\Application\DTOs\GetPaymentDetails\ResponseDto as GetPaymentDetailsResponseDto;
use OnlinePayments\ExampleApp\Application\DTOs\Payment\RequestDto as CreatePaymentRequestDto;
use OnlinePayments\ExampleApp\Application\DTOs\Payment\ResponseDto as CreatePaymentResponseDto;

interface PaymentServiceInterface
{
    public function createPayment(CreatePaymentRequestDto $requestDto): CreatePaymentResponseDto;
    public function getPaymentDetailsById(string $id): GetPaymentDetailsResponseDto;
    public function capturePayment(RequestDto $requestDto): ResponseDto;
    public function refundPayment(RequestDto $requestDto): ResponseDto;
    public function cancelPayment(RequestDto $requestDto): ResponseDto;
}
