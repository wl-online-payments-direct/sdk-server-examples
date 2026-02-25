<?php

namespace OnlinePayments\ExampleApp\Application\DTOs\Payment;

use OnlinePayments\ExampleApp\Application\Domain\Enums\AdditionalPaymentActions\Status;
use OnlinePayments\ExampleApp\Application\Domain\Payments\StatusOutput;

class ResponseDto
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
}
