<?php

namespace OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails;

final class CurrencyConversion
{
    public ?bool $acceptedByUser = null;
    public ?DccProposal $proposal = null;

    public function toArray(): array
    {
        return [
            'acceptedByUser' => $this->acceptedByUser,
            'proposal' => ($this->proposal ?? new DccProposal())->toArray(),
        ];
    }
}
