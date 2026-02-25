<?php

namespace OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails;

final class SepaDirectDebitPaymentMethodSpecificOutput
{
    public ?FraudResults $fraudResults = null;
    public ?PaymentProduct771SpecificOutput $paymentProduct771SpecificOutput = null;
    public ?int $paymentProductId = null;

    public function __construct(
        ?int $paymentProductId = null,
        ?FraudResults $fraudResults = null,
        ?PaymentProduct771SpecificOutput $paymentProduct771SpecificOutput = null
    ) {
        $this->paymentProductId = $paymentProductId;
        $this->fraudResults = $fraudResults;
        $this->paymentProduct771SpecificOutput = $paymentProduct771SpecificOutput;
    }

    public function toArray(): array
    {
        return [
            'paymentProductId' => $this->paymentProductId,
            'fraudResults' => ($this->fraudResults ?? new FraudResults())->toArray(),
            'paymentProduct771SpecificOutput' => ($this->paymentProduct771SpecificOutput ?? new PaymentProduct771SpecificOutput())->toArray(),
        ];
    }
}
