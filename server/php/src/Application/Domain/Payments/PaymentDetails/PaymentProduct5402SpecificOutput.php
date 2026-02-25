<?php

namespace OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails;

final class PaymentProduct5402SpecificOutput
{
    public ?string $brand = null;

    public function __construct(?string $brand = null)
    {
        $this->brand = $brand;
    }

    public function toArray(): array
    {
        return [
            'brand' => $this->brand,
        ];
    }
}
