<?php

namespace OnlinePayments\ExampleApp\Presentation\Models\GetPaymentDetails;

use OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails\HostedCheckoutSpecificOutput;
use OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails\OperationOutput;
use OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails\PaymentOutput;
use OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails\PaymentStatusOutput;
use OnlinePayments\ExampleApp\Application\Interfaces\Responses\ResponseInterface;

class Response implements ResponseInterface
{
    /** @var OperationOutput[]|null */
    public ?array $operations = null;

    public ?HostedCheckoutSpecificOutput $hostedCheckoutSpecificOutput = null;

    public ?PaymentOutput $paymentOutput = null;

    public ?string $status = null;

    public ?PaymentStatusOutput $statusOutput = null;

    public ?string $id = null;

    public function toArray(): array
    {
        return [
            'operations' => $this->operations !== null
                ? array_map(
                    fn (OperationOutput $op) => $op->toArray(),
                    $this->operations
                )
                : [],
            'hostedCheckoutSpecificOutput' => ($this->hostedCheckoutSpecificOutput ?? new HostedCheckoutSpecificOutput())->toArray(),
            'paymentOutput' => ($this->paymentOutput ?? new PaymentOutput())->toArray(),
            'status' => $this->status,
            'statusOutput' => ($this->statusOutput ?? new PaymentStatusOutput())->toArray(),
            'id' => $this->id,
        ];
    }
}
