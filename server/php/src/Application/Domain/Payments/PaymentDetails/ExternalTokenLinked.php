<?php

namespace OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails;

final class ExternalTokenLinked
{
    public ?string $computedToken = null;
    public ?string $gtsComputedToken = null;
    public ?string $generatedToken = null;

    public function toArray(): array
    {
        return [
            'computedToken' => $this->computedToken,
            'gtsComputedToken' => $this->gtsComputedToken,
            'generatedToken' => $this->generatedToken,
        ];
    }
}
