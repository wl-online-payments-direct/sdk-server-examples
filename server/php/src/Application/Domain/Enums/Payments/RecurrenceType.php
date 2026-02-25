<?php

namespace OnlinePayments\ExampleApp\Application\Domain\Enums\Payments;

enum RecurrenceType: string
{
    case UNIQUE = 'UNIQUE';
    case RECURRING = 'RECURRING';
}
