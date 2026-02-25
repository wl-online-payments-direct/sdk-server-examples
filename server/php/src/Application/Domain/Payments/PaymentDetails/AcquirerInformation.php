<?php

namespace OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails;

final class AcquirerInformation
{
    public ?AcquirerSelectionInformation $acquirerSelectionInformation = null;
    public ?string $name = null;

    public function toArray(): array
    {
        return [
            'acquirerSelectionInformation' => (
                $this->acquirerSelectionInformation ?? new AcquirerSelectionInformation()
            )->toArray(),
            'name' => $this->name,
        ];
    }
}
