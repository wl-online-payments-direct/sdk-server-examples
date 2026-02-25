<?php

namespace OnlinePayments\ExampleApp\Application\Domain\Enums\Payments;

enum SignatureType: string
{
    case SMS = 'SMS';
    case UNSIGNED = 'UNSIGNED';
    case TICK_BOX = 'TICK_BOX';
}