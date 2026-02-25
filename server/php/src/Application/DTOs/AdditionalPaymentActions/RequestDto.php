<?php

namespace OnlinePayments\ExampleApp\Application\DTOs\AdditionalPaymentActions;

use OnlinePayments\ExampleApp\Application\Domain\Enums\Common\Currency;

final class RequestDto
{
    public int $amount;

    public ?Currency $currency = null;

    public ?bool $isFinal = null;

    public string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }
}
