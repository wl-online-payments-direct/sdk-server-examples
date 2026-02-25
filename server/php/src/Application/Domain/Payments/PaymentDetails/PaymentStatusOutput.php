<?php

namespace OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails;

final class PaymentStatusOutput
{
    /** @var APIError[]|null */
    public ?array $errors = null;
    public ?bool $isAuthorized = null;
    public ?bool $isCancellable = null;
    public ?bool $isRefundable = null;
    public ?string $statusCategory = null;
    public ?int $statusCode = null;
    public ?string $statusCodeChangeDateTime = null;

    public function toArray(): array
    {
        return [
            'errors' => $this->errors ? array_map(fn($e) => $e->toArray(), $this->errors) : null,
            'isAuthorized' => $this->isAuthorized,
            'isCancellable' => $this->isCancellable,
            'isRefundable' => $this->isRefundable,
            'statusCategory' => $this->statusCategory,
            'statusCode' => $this->statusCode,
            'statusCodeChangeDateTime' => $this->statusCodeChangeDateTime,
        ];
    }
}
