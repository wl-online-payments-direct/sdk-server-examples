<?php

namespace OnlinePayments\ExampleApp\Application\Services;

use Exception;
use OnlinePayments\ExampleApp\Application\DTOs\AdditionalPaymentActions\RequestDto;
use OnlinePayments\ExampleApp\Application\DTOs\AdditionalPaymentActions\ResponseDto;
use OnlinePayments\ExampleApp\Application\DTOs\GetPaymentDetails\ResponseDto as GetPaymentDetailsResponseDto;
use OnlinePayments\ExampleApp\Application\DTOs\Payment\RequestDto as CreatePaymentRequestDto;
use OnlinePayments\ExampleApp\Application\DTOs\Payment\ResponseDto as CreatePaymentResponseDto;
use OnlinePayments\ExampleApp\Application\Interfaces\Handlers\PaymentMethodHandlerInterface;
use OnlinePayments\ExampleApp\Application\Interfaces\SDKClients\PaymentClientInterface;
use OnlinePayments\ExampleApp\Application\Interfaces\Services\PaymentServiceInterface;
use OnlinePayments\ExampleApp\Configuration\Exceptions\ValidationException;

readonly class PaymentService implements PaymentServiceInterface
{
    /**
     * @param iterable<PaymentMethodHandlerInterface> $handlers
     */
    public function __construct(
        private PaymentClientInterface $paymentClient,
        private iterable $handlers,
    ) {}

    /**
     * @throws ValidationException
     */
    public function createPayment(CreatePaymentRequestDto $requestDto): CreatePaymentResponseDto
    {
        $handler = null;

        foreach ($this->handlers as $candidate) {
            if ($candidate->getSupportedMethod() === $requestDto->method) {
                $handler = $candidate;
                break;
            }
        }

        if ($handler === null) {
            throw new ValidationException(
                (array)'Unsupported payment method.'
            );
        }

        return $handler->handle($requestDto);
    }

    public function getPaymentDetailsById(string $id): GetPaymentDetailsResponseDto
    {
        return $this->paymentClient->getPaymentDetailsById($id);
    }

    /**
     * @throws Exception
     */
    public function capturePayment(RequestDto $requestDto): ResponseDto
    {
        return $this->paymentClient->capturePayment($requestDto);
    }

    /**
     * @throws Exception
     */
    public function refundPayment(RequestDto $requestDto): ResponseDto
    {
        return $this->paymentClient->refundPayment($requestDto);
    }

    /**
     * @throws Exception
     */
    public function cancelPayment(RequestDto $requestDto): ResponseDto
    {
        return $this->paymentClient->cancelPayment($requestDto);
    }
}