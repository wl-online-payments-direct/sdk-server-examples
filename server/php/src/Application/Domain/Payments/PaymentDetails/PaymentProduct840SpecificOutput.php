<?php

namespace OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails;

final class PaymentProduct840SpecificOutput
{
    public ?Address $billingAddress = null;
    public ?PaymentProduct840CustomerAccount $customerAccount = null;
    public ?Address $customerAddress = null;
    public ?ProtectionEligibility $protectionEligibility = null;

    public function toArray(): array
    {
        return [
            'billingAddress' => ($this->billingAddress ?? new Address())->toArray(),
            'customerAccount' => ($this->customerAccount ?? new PaymentProduct840CustomerAccount())->toArray(),
            'customerAddress' => ($this->customerAddress ?? new Address())->toArray(),
            'protectionEligibility' => ($this->protectionEligibility ?? new ProtectionEligibility())->toArray(),
        ];
    }
}
