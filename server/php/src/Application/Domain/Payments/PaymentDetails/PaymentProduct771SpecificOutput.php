<?php

namespace OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails;

final class PaymentProduct771SpecificOutput
{
    public ?string $mandateReference = null;

    public function __construct(?string $mandateReference = null)
    {
        $this->mandateReference = $mandateReference;
    }

    public function toArray(): array
    {
        return [
            'mandateReference' => $this->mandateReference,
        ];
    }
}
