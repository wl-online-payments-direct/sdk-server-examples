<?php

namespace OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails;

final class CustomerOutput
{
    public ?CustomerDeviceOutput $device = null;

    public function toArray(): array
    {
        return [
            'device' => $this->device?->toArray(),
        ];
    }
}
