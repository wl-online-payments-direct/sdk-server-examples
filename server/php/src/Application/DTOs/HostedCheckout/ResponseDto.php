<?php

namespace OnlinePayments\ExampleApp\Application\DTOs\HostedCheckout;

use OnlinePayments\ExampleApp\Application\Domain\Enums\Common\Currency;

class ResponseDto
{
    public ?string $hostedCheckoutId;
    public ?string $redirectUrl;
    public ?string $returnMAC;
    public ?int $amount;
    public ?Currency $currency;

    public function __construct(
        ?string $hostedCheckoutId,
        ?string $redirectUrl,
        ?string $returnMAC
    ) {
        $this->hostedCheckoutId = $hostedCheckoutId;
        $this->redirectUrl = $redirectUrl;
        $this->returnMAC = $returnMAC;
    }
}
