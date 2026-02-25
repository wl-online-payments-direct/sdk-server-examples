<?php

namespace OnlinePayments\ExampleApp\Application\Domain\Enums\PaymentLinks;

enum Action: string {
    case PREVIEW = 'PREVIEW';
    case CREATE = 'CREATE';
}