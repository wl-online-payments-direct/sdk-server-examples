<?php

namespace OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails;

final class PaymentProduct3209SpecificOutput
{
    public ?string $buyerCompliantBankMessage = null;

    public function toArray(): array
    {
        return [
            'buyerCompliantBankMessage' => $this->buyerCompliantBankMessage,
        ];
    }
}
