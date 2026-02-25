<?php

namespace OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails;

final class PaymentOutput
{
    public ?AmountOfMoney $amountOfMoney = null;
    public ?PaymentReferences $references = null;
    public ?AmountOfMoney $acquiredAmount = null;
    public ?CustomerOutput $customer = null;
    public ?CardPaymentMethodSpecificOutput $cardPaymentMethodSpecificOutput = null;
    public ?string $paymentMethod = null;
    public ?string $merchantParameters = null;
    public ?Discount $discount = null;
    public ?SurchargeSpecificOutput $surchargeSpecificOutput = null;
    public ?SepaDirectDebitPaymentMethodSpecificOutput $sepaDirectDebitPaymentMethodSpecificOutput = null;
    public ?RedirectPaymentMethodSpecificOutput $redirectPaymentMethodSpecificOutput = null;
    public ?MobilePaymentMethodSpecificOutput $mobilePaymentMethodSpecificOutput = null;

    public function toArray(): array
    {
        return [
            'amountOfMoney' => $this->amountOfMoney?->toArray(),
            'references' => $this->references?->toArray(),
            'acquiredAmount' => $this->acquiredAmount?->toArray(),
            'customer' => $this->customer?->toArray(),
            'cardPaymentMethodSpecificOutput' => $this->cardPaymentMethodSpecificOutput?->toArray(),
            'paymentMethod' => $this->paymentMethod,
            'merchantParameters' => $this->merchantParameters,
            'discount' => ($this->discount ?? new Discount())->toArray(),
            'surchargeSpecificOutput' => ($this->surchargeSpecificOutput ?? new SurchargeSpecificOutput())->toArray(),
            'sepaDirectDebitPaymentMethodSpecificOutput' => ($this->sepaDirectDebitPaymentMethodSpecificOutput ?? new SepaDirectDebitPaymentMethodSpecificOutput())->toArray(),
            'redirectPaymentMethodSpecificOutput' => ($this->redirectPaymentMethodSpecificOutput ?? new RedirectPaymentMethodSpecificOutput())->toArray(),
            'mobilePaymentMethodSpecificOutput' => ($this->mobilePaymentMethodSpecificOutput ?? new MobilePaymentMethodSpecificOutput())->toArray(),
        ];
    }
}
