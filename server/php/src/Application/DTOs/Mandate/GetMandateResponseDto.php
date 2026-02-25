<?php

namespace OnlinePayments\ExampleApp\Application\DTOs\Mandate;

class GetMandateResponseDto
{
    public ?string $uniqueMandateReference;

    public function __construct(?string $uniqueMandateReference)
    {
        $this->uniqueMandateReference = $uniqueMandateReference;
    }
}