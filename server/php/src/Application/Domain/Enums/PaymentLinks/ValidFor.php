<?php

namespace OnlinePayments\ExampleApp\Application\Domain\Enums\PaymentLinks;

enum ValidFor: int {
    case ONE_DAY = 24;
    case TWO_DAYS = 48;
    case TWO_WEEKS = 336;
    case ONE_MONTH= 720;
}