<?php

namespace OnlinePayments\ExampleApp\Application\Domain\Enums\Common;

enum StatusCategory: string
{
    case CREATED = 'CREATED';
    case UNSUCCESSFUL = 'UNSUCCESSFUL';
    case PENDING_PAYMENT = 'PENDING_PAYMENT';
    case PENDING_MERCHANT = 'PENDING_MERCHANT';
    case PENDING_CONNECT_OR_3RD_PARTY = 'PENDING_CONNECT_OR_3RD_PARTY';
    case COMPLETED = 'COMPLETED';
    case REVERSED = 'REVERSED';
    case REFUNDED = 'REFUNDED';
}
