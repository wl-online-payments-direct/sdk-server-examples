<?php

namespace OnlinePayments\ExampleApp\Application\Domain\Payments;

use OnlinePayments\ExampleApp\Application\Domain\Enums\Common\StatusCategory;

class StatusOutput
{
    public ?int $statusCode;
    public ?StatusCategory $statusCategory;

    public function __construct(?int $statusCode = null, ?StatusCategory $statusCategory = null)
    {
        $this->statusCode = $statusCode;
        $this->statusCategory = $statusCategory;
    }
}
