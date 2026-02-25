<?php

namespace OnlinePayments\ExampleApp\Presentation\Models\HostedCheckout;

use OnlinePayments\ExampleApp\Application\Domain\Enums\Common\Currency;
use OnlinePayments\ExampleApp\Application\Interfaces\Responses\ResponseInterface;

class Response implements ResponseInterface
{
    public string $hostedCheckoutId;
    public string $redirectUrl;
    public ?string $returnMAC;
    public string $amount;
    public ?Currency $currency;

    public function __construct(
        string $hostedCheckoutId,
        string $redirectUrl,
        ?string $returnMAC,
        string $amount,
        ?Currency $currency
    ) {
        $this->hostedCheckoutId = $hostedCheckoutId;
        $this->redirectUrl = $redirectUrl;
        $this->returnMAC = $returnMAC;
        $this->amount = $amount;
        $this->currency = $currency;
    }

    public function toArray(): array
    {
        return [
            'hostedCheckoutId' => $this->hostedCheckoutId,
            'redirectUrl' => $this->redirectUrl,
            'returnMAC' => $this->returnMAC,
            'amount' => $this->amount,
            'currency' => $this->currency,
        ];
    }
}
