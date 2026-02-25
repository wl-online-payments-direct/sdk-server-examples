<?php

namespace OnlinePayments\ExampleApp\Application\Enums\PaymentLinks;

enum Action: string {
    case PREVIEW = 'PREVIEW';
    case CREATE = 'CREATE';
}