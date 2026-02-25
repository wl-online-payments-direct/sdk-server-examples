<?php

namespace OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails;

final class RedirectPaymentMethodSpecificOutput
{
    public ?string $authorisationCode = null;
    public ?CustomerBankAccount $customerBankAccount = null;
    public ?FraudResults $fraudResults = null;
    public ?string $paymentOption = null;
    public ?PaymentProduct3203SpecificOutput $paymentProduct3203SpecificOutput = null;
    public ?PaymentProduct5001SpecificOutput $paymentProduct5001SpecificOutput = null;
    public ?PaymentProduct5402SpecificOutput $paymentProduct5402SpecificOutput = null;
    public ?PaymentProduct5500SpecificOutput $paymentProduct5500SpecificOutput = null;
    public ?PaymentProduct840SpecificOutput $paymentProduct840SpecificOutput = null;
    public ?int $paymentProductId = null;
    public ?string $token = null;

    public function toArray(): array
    {
        return [
            'authorisationCode' => $this->authorisationCode,
            'customerBankAccount' => ($this->customerBankAccount ?? new CustomerBankAccount())->toArray(),
            'fraudResults' => ($this->fraudResults ?? new FraudResults())->toArray(),
            'paymentOption' => $this->paymentOption,
            'paymentProduct3203SpecificOutput' => ($this->paymentProduct3203SpecificOutput ?? new PaymentProduct3203SpecificOutput())->toArray(),
            'paymentProduct5001SpecificOutput' => ($this->paymentProduct5001SpecificOutput ?? new PaymentProduct5001SpecificOutput())->toArray(),
            'paymentProduct5402SpecificOutput' => ($this->paymentProduct5402SpecificOutput ?? new PaymentProduct5402SpecificOutput())->toArray(),
            'paymentProduct5500SpecificOutput' => ($this->paymentProduct5500SpecificOutput ?? new PaymentProduct5500SpecificOutput())->toArray(),
            'paymentProduct840SpecificOutput' => ($this->paymentProduct840SpecificOutput ?? new PaymentProduct840SpecificOutput())->toArray(),
            'paymentProductId' => $this->paymentProductId,
            'token' => $this->token,
        ];
    }

}
