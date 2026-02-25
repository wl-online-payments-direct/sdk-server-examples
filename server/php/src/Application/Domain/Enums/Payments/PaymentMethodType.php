<?php

namespace OnlinePayments\ExampleApp\Application\Domain\Enums\Payments;

enum PaymentMethodType: string
{
    case TOKEN = 'TOKEN';
    case CREDIT_CARD = 'CREDIT_CARD';
    case DIRECT_DEBIT = 'DIRECT_DEBIT';
}
