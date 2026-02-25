<?php

namespace OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails;

final class PaymentProduct5500SpecificOutput
{
    public ?string $entityId = null;
    public ?string $paymentEndDate = null;
    public ?string $paymentReference = null;
    public ?string $paymentStartDate = null;

    public function __construct(
        ?string $paymentReference = null,
        ?string $paymentEndDate = null,
        ?string $paymentStartDate = null,
        ?string $entityId = null
    ) {
        $this->paymentReference = $paymentReference;
        $this->paymentEndDate = $paymentEndDate;
        $this->paymentStartDate = $paymentStartDate;
        $this->entityId = $entityId;
    }

    public function toArray(): array
    {
        return [
            'entityId' => $this->entityId,
            'paymentEndDate' => $this->paymentEndDate,
            'paymentReference' => $this->paymentReference,
            'paymentStartDate' => $this->paymentStartDate,
        ];
    }
}
