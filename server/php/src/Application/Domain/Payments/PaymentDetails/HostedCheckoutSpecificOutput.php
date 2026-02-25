<?php

namespace OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails;

final class HostedCheckoutSpecificOutput
{
    public ?string $hostedCheckoutId = null;
    public ?string $variant = null;

    public function toArray(): array
    {
        return [
            'hostedCheckoutId' => $this->hostedCheckoutId,
            'variant' => $this->variant,
        ];
    }
}
