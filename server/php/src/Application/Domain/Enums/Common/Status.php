<?php

namespace OnlinePayments\ExampleApp\Application\Domain\Enums\Common;

enum Status: string
{
    case ACTIVE = 'ACTIVE';
    case INACTIVE = 'INACTIVE';
    case EXPIRED = 'EXPIRED';
}