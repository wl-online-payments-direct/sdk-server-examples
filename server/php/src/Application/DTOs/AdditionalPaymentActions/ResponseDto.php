<?php

namespace OnlinePayments\ExampleApp\Application\DTOs\AdditionalPaymentActions;

use OnlinePayments\ExampleApp\Application\Domain\Enums\AdditionalPaymentActions\Status;
use OnlinePayments\ExampleApp\Application\Domain\Payments\StatusOutput;

final class ResponseDto
{
    public ?string $id = null;

    public ?Status $status = null;

    public ?StatusOutput $statusOutput = null;
}
