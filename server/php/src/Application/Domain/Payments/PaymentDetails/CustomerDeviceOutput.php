<?php

namespace OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails;

final class CustomerDeviceOutput
{
    public ?string $ipAddressCountryCode = null;

    public function toArray(): array
    {
        return [
            'ipAddressCountryCode' => $this->ipAddressCountryCode,
        ];
    }
}
