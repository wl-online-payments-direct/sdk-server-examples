<?php

namespace OnlinePayments\ExampleApp\Presentation\Models\AdditionalPaymentActions;

use OnlinePayments\ExampleApp\Application\Domain\Enums\AdditionalPaymentActions\Status;
use OnlinePayments\ExampleApp\Application\Domain\Payments\StatusOutput;
use OnlinePayments\ExampleApp\Application\Interfaces\Responses\ResponseInterface;

final class Response implements ResponseInterface
{
    public ?string $id = null;

    public ?Status $status = null;

    public ?StatusOutput $statusOutput = null;

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status?->value ?? null,
            'statusOutput' => $this->statusOutput ? [
                'statusCode' => $this->statusOutput->statusCode,
                'statusCategory' => $this->statusOutput->statusCategory,
            ] : null
        ];
    }
}
