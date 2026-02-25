<?php

namespace OnlinePayments\ExampleApp\Application\DTOs\GetPaymentDetails;

use OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails\OperationOutput;
use OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails\HostedCheckoutSpecificOutput;
use OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails\PaymentOutput;
use OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails\PaymentStatusOutput;

final class ResponseDto
{
    /** @var OperationOutput[]|null Array of OperationOutput objects */
    public ?array $operations = null;

    public ?HostedCheckoutSpecificOutput $hostedCheckoutSpecificOutput = null;

    public ?PaymentOutput $paymentOutput = null;

    public ?string $status = null;

    public ?PaymentStatusOutput $statusOutput = null;

    public ?string $id = null;
}
