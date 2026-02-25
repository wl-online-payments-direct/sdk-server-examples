<?php

namespace OnlinePayments\ExampleApp\Application\DTOs\Payment;

use OnlinePayments\ExampleApp\Application\Domain\Enums\Common\Currency;
use OnlinePayments\ExampleApp\Application\Domain\Enums\Payments\PaymentMethodType;
use OnlinePayments\ExampleApp\Application\Domain\Payments\Card;
use OnlinePayments\ExampleApp\Application\Domain\Payments\Mandate;
use OnlinePayments\ExampleApp\Application\DTOs\Common\AddressDto;

class RequestDto
{
    public ?int $amount;
    public ?Currency $currency;
    public ?PaymentMethodType $method;

    public ?string $hostedTokenizationId;

    public ?AddressDto $shippingAddress;
    public ?AddressDto $billingAddress;

    public ?Card $card;
    public ?Mandate $mandate;

    public ?int $paymentProductId;

    public function __construct(
        ?int $amount = null,
        ?Currency $currency = null,
        ?PaymentMethodType $method = null,
        ?string $hostedTokenizationId = null,
        ?AddressDto $shippingAddress = null,
        ?AddressDto $billingAddress = null,
        ?Card $card = null,
        ?Mandate $mandate = null,
        ?int $paymentProductId = null
    ) {
        $this->amount = $amount;
        $this->currency = $currency;
        $this->method = $method;
        $this->hostedTokenizationId = $hostedTokenizationId;
        $this->shippingAddress = $shippingAddress;
        $this->billingAddress = $billingAddress;
        $this->card = $card;
        $this->mandate = $mandate;
        $this->paymentProductId = $paymentProductId;
    }
}
