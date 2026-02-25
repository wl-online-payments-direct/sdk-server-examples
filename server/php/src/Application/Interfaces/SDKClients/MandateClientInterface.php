<?php

namespace OnlinePayments\ExampleApp\Application\Interfaces\SDKClients;

use OnlinePayments\ExampleApp\Application\Domain\Payments\Mandate;
use OnlinePayments\ExampleApp\Application\DTOs\Mandate\GetMandateResponseDto;
use OnlinePayments\ExampleApp\Application\DTOs\Payment\RequestDto;

interface MandateClientInterface
{
    public function createMandate(RequestDto $requestDto): Mandate;
    public function getMandate(?string $existingUniqueMandateReference): ?GetMandateResponseDto;
}
