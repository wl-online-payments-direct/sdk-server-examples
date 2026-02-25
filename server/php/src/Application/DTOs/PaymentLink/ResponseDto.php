<?php

namespace OnlinePayments\ExampleApp\Application\DTOs\PaymentLink;

use OnlinePayments\ExampleApp\Application\Domain\Enums\Common\Currency;
use OnlinePayments\ExampleApp\Application\Domain\Enums\Common\Status;

class ResponseDto
{
    public ?string $redirectUrl;
    public ?string $paymentLinkId;
    public ?Status $status;
    public ?int $amount;
    public ?Currency $currency;

    public function __construct(
        ?string $redirectUrl,
        ?string $paymentLinkId,
        ?Status $status,
        ?int $amount,
        ?Currency $currency
    ) {
        $this->redirectUrl = $redirectUrl;
        $this->paymentLinkId = $paymentLinkId;
        $this->status = $status;
        $this->amount = $amount;
        $this->currency = $currency;
    }
}
