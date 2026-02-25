<?php

namespace OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails;

final class PaymentProduct3203SpecificOutput
{
    public ?AddressPersonal $billingAddress = null;
    public ?AddressPersonal $shippingAddress = null;

    public function toArray(): array
    {
        return [
            'billingAddress' => ($this->billingAddress ?? new AddressPersonal())->toArray(),
            'shippingAddress' => ($this->shippingAddress ?? new AddressPersonal())->toArray(),
        ];
    }
}
