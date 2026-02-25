<?php

namespace OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails;

final class ReattemptInstructions
{
    public ?ReattemptInstructionsConditions $conditions = null;
    public ?int $frozenPeriod = null;
    public ?string $indicator = null;

    public function toArray(): array
    {
        return [
            'conditions' => ($this->conditions ?? new ReattemptInstructionsConditions())->toArray(),
            'frozenPeriod' => $this->frozenPeriod,
            'indicator' => $this->indicator,
        ];
    }
}
