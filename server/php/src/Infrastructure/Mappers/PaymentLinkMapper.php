<?php

namespace OnlinePayments\ExampleApp\Infrastructure\Mappers;

use OnlinePayments\ExampleApp\Application\Domain\Enums\Common\Currency;
use OnlinePayments\ExampleApp\Application\Domain\Enums\Common\Status;
use OnlinePayments\ExampleApp\Application\DTOs\PaymentLink\RequestDto;
use OnlinePayments\ExampleApp\Application\DTOs\PaymentLink\ResponseDto;
use OnlinePayments\Sdk\Domain\AmountOfMoney;
use OnlinePayments\Sdk\Domain\CreatePaymentLinkRequest;
use OnlinePayments\Sdk\Domain\Order;
use OnlinePayments\Sdk\Domain\OrderReferences;
use OnlinePayments\Sdk\Domain\PaymentLinkResponse;
use OnlinePayments\Sdk\Domain\PaymentLinkSpecificInput;

class PaymentLinkMapper
{
    private const SMALLEST_UNIT = 100;

    /**
     * @throws \Exception
     */
    public static function mapToSdkRequest(RequestDto $requestDto): CreatePaymentLinkRequest
    {
        $sdkRequest = new CreatePaymentLinkRequest();

        $order = new Order();
        $amountOfMoney = new AmountOfMoney();

        $amountOfMoney->setAmount((int)($requestDto->amount * self::SMALLEST_UNIT));
        $amountOfMoney->setCurrencyCode($requestDto->currency->value);
        $order->setAmountOfMoney($amountOfMoney);

        $refs = new OrderReferences();
        $refs->setMerchantReference(bin2hex(random_bytes(16)));
        $order->setReferences($refs);

        $sdkRequest->setOrder($order);

        $paymentLinkSpecificInput = new PaymentLinkSpecificInput();
        if ($requestDto->description !== null) {
            $paymentLinkSpecificInput->setDescription($requestDto->description);
        }

        if ($requestDto->validFor !== null) {
            $expiration = new \DateTime('now', new \DateTimeZone('UTC'));
            $expiration = $expiration->add(new \DateInterval('PT' . $requestDto->validFor->value . 'H'));
            $paymentLinkSpecificInput->setExpirationDate($expiration);
        }

        $sdkRequest->setPaymentLinkSpecificInput($paymentLinkSpecificInput);

        return $sdkRequest;
    }

    public static function mapFromSdkResponse(?PaymentLinkResponse $response): ResponseDto
    {
        $currency = null;
        if ($response?->getPaymentLinkOrder()?->getAmount()?->getCurrencyCode() !== null) {
            $currency = Currency::tryFrom(strtoupper($response->getPaymentLinkOrder()->getAmount()->getCurrencyCode()));
        }

        $status = null;
        if ($response?->getStatus() !== null) {
            $status = Status::tryFrom(strtoupper($response->getStatus()));
        }

        return new ResponseDto(
            redirectUrl: $response?->getRedirectionUrl() ?? '',
            paymentLinkId: $response?->getPaymentLinkId(),
            status: $status,
            amount: $response?->getPaymentLinkOrder()?->getAmount()?->getAmount(),
            currency: $currency
        );
    }
}
