<?php

namespace OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails;

final class PaymentProduct840CustomerAccount
{
    public ?string $accountId = null;
    public ?string $companyName = null;
    public ?string $countryCode = null;
    public ?string $customerAccountStatus = null;
    public ?string $customerAddressStatus = null;
    public ?string $firstName = null;
    public ?string $payerId = null;
    public ?string $surname = null;

    public function toArray(): array
    {
        return [
            'accountId' => $this->accountId,
            'companyName' => $this->companyName,
            'countryCode' => $this->countryCode,
            'customerAccountStatus' => $this->customerAccountStatus,
            'customerAddressStatus' => $this->customerAddressStatus,
            'firstName' => $this->firstName,
            'payerId' => $this->payerId,
            'surname' => $this->surname,
        ];
    }
}
