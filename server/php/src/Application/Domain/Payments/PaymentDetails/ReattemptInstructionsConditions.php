<?php

namespace OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails;

final class ReattemptInstructionsConditions
{
    public ?int $maxAttempts = null;
    public ?int $maxDelay = null;

    public function toArray(): array
    {
        return [
            'maxAttempts' => $this->maxAttempts,
            'maxDelay' => $this->maxDelay,
        ];
    }
}
