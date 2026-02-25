<?php

namespace OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails;

final class PaymentProduct5001SpecificOutput
{
    public ?string $accountNumber = null;
    public ?string $authorisationCode = null;
    public ?string $liability = null;
    public ?string $mobilePhoneNumber = null;
    public ?string $operationCode = null;

    public function __construct(
        ?string $liability = null,
        ?string $accountNumber = null,
        ?string $authorisationCode = null,
        ?string $operationCode = null,
        ?string $mobilePhoneNumber = null
    ) {
        $this->liability = $liability;
        $this->accountNumber = $accountNumber;
        $this->authorisationCode = $authorisationCode;
        $this->operationCode = $operationCode;
        $this->mobilePhoneNumber = $mobilePhoneNumber;
    }

    public function toArray(): array
    {
        return [
            'accountNumber' => $this->accountNumber,
            'authorisationCode' => $this->authorisationCode,
            'liability' => $this->liability,
            'mobilePhoneNumber' => $this->mobilePhoneNumber,
            'operationCode' => $this->operationCode,
        ];
    }
}
