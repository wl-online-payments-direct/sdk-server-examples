<?php

namespace OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails;

final class ProtectionEligibility
{
    public ?string $eligibility = null;
    public ?string $type = null;

    public function toArray(): array
    {
        return [
            'eligibility' => $this->eligibility,
            'type' => $this->type,
        ];
    }
}
