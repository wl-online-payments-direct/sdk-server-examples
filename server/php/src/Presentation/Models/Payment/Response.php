<?php

namespace OnlinePayments\ExampleApp\Presentation\Models\Payment;

use OnlinePayments\ExampleApp\Application\Domain\Enums\AdditionalPaymentActions\Status;
use OnlinePayments\ExampleApp\Application\Domain\Payments\StatusOutput;
use OnlinePayments\ExampleApp\Application\Interfaces\Responses\ResponseInterface;

class Response implements ResponseInterface
{
    public ?string $id;
    public ?Status $status;
    public ?StatusOutput $statusOutput;

    public function __construct(
        ?string $id = null,
        ?Status $status = null,
        ?StatusOutput $statusOutput = null
    ) {
        $this->id = $id;
        $this->status = $status;
        $this->statusOutput = $statusOutput ?? new StatusOutput();
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status?->value,
            'statusOutput' => $this->statusOutput ? [
                'statusCode' => $this->statusOutput->statusCode,
                'statusCategory' => $this->statusOutput->statusCategory?->value
            ] : null
        ];
    }
}
