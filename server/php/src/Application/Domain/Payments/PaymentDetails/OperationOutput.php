<?php

namespace OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails;

final class OperationOutput
{
    public ?AmountOfMoney $amountOfMoney = null;
    public ?string $id = null;
    public ?OperationPaymentReferences $operationReferences = null;
    public ?string $paymentMethod = null;
    public ?PaymentReferences $references = null;
    public ?string $status = null;
    public ?PaymentStatusOutput $statusOutput = null;

    public function toArray(): array
    {
        return [
            'amountOfMoney' => $this->amountOfMoney?->toArray(),
            'id' => $this->id,
            'operationReferences' => $this->operationReferences?->toArray(),
            'paymentMethod' => $this->paymentMethod,
            'references' => $this->references?->toArray(),
            'status' => $this->status,
            'statusOutput' => $this->statusOutput?->toArray(),
        ];
    }
}
