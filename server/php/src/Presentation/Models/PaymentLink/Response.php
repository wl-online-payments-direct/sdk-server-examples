<?php

namespace OnlinePayments\ExampleApp\Presentation\Models\PaymentLink;

use OnlinePayments\ExampleApp\Application\Domain\Enums\Common\Currency;
use OnlinePayments\ExampleApp\Application\Domain\Enums\Common\Status;
use OnlinePayments\ExampleApp\Application\Interfaces\Responses\ResponseInterface;

class Response implements ResponseInterface
{
    private string $paymentLinkId;
    private string $redirectUrl;
    private ?Status $status;
    private ?int $amount;
    private ?Currency $currency;

    public function __construct(
        string $paymentLinkId,
        string $redirectUrl,
        ?Status $status,
        ?int $amount,
        ?Currency $currency
    ) {
        $this->paymentLinkId = $paymentLinkId;
        $this->redirectUrl = $redirectUrl;
        $this->status = $status;
        $this->amount = $amount;
        $this->currency = $currency;
    }

    public function toArray(): array
    {
        return [
            'paymentLinkId' => $this->paymentLinkId,
            'redirectUrl'   => $this->redirectUrl,
            'status'        => $this->status,
            'amount'        => $this->amount,
            'currency'      => $this->currency->value,
        ];
    }
}
