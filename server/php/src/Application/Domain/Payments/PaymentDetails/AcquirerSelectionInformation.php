<?php

namespace OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails;

final class AcquirerSelectionInformation
{
    public ?int $fallbackLevel = null;
    public ?string $result = null;
    public ?string $ruleName = null;

    public function toArray(): array
    {
        return [
            'fallbackLevel' => $this->fallbackLevel,
            'result' => $this->result,
            'ruleName' => $this->ruleName,
        ];
    }
}
