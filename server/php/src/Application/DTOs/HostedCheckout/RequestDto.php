<?php

namespace OnlinePayments\ExampleApp\Application\DTOs\HostedCheckout;

use OnlinePayments\ExampleApp\Application\Domain\Enums\Common\Currency;
use OnlinePayments\ExampleApp\Application\Domain\Enums\Common\Language;
use OnlinePayments\ExampleApp\Application\DTOs\Common\AddressDto;

class RequestDto
{
    public ?int $amount;
    public ?Currency $currency;
    public ?Language $language;
    public ?AddressDto $billingAddress;
    public ?AddressDto $shippingAddress;
    public ?string $redirectUrl;

    public function __construct(
        ?int $amount,
        ?Currency $currency,
        ?Language $language = null,
        ?AddressDto $billingAddress = null,
        ?AddressDto $shippingAddress = null,
        ?string $redirectUrl = null
    ) {
        $this->amount = $amount;
        $this->currency = $currency;
        $this->language = $language;
        $this->billingAddress = $billingAddress;
        $this->shippingAddress = $shippingAddress;
        $this->redirectUrl = $redirectUrl;
    }
}
