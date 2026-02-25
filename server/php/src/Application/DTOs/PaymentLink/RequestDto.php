<?php

namespace OnlinePayments\ExampleApp\Application\DTOs\PaymentLink;

use OnlinePayments\ExampleApp\Application\Domain\Enums\Common\Currency;
use OnlinePayments\ExampleApp\Application\Domain\Enums\PaymentLinks\Action;
use OnlinePayments\ExampleApp\Application\Domain\Enums\PaymentLinks\ValidFor;

class RequestDto
{
    public ?int $amount;
    public ?Currency $currency;
    public ?string $description = null;
    public ?ValidFor $validFor;
    public ?Action $action;

    public function __construct(
        ?int $amount,
        ?Currency $currency,
        ?string $description = null,
        ?ValidFor $validFor = null,
        ?Action $action = null
    ) {
        $this->amount = $amount;
        $this->currency = $currency;
        $this->description = $description;
        $this->validFor = $validFor;
        $this->action = $action;
    }
}