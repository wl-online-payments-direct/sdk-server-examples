<?php

namespace OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails;

final class CustomerBankAccount
{
    public ?string $accountHolderName = null;
    public ?string $bic = null;
    public ?string $iban = null;

    public function toArray(): array
    {
        return [
            'accountHolderName' => $this->accountHolderName,
            'bic' => $this->bic,
            'iban' => $this->iban,
        ];
    }
}
