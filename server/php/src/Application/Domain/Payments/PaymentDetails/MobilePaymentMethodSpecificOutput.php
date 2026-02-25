<?php

namespace OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails;

final class MobilePaymentMethodSpecificOutput
{
    public ?string $authorisationCode = null;
    public ?CardFraudResults $fraudResults = null;
    public ?string $network = null;
    public ?MobilePaymentData $paymentData = null;
    public ?int $paymentProductId = null;
    public ?ThreeDSecureResults $threeDSecureResults = null;

    public function toArray(): array
    {
        return [
            'authorisationCode' => $this->authorisationCode,
            'fraudResults' => ($this->fraudResults ?? new CardFraudResults())->toArray(),
            'network' => $this->network,
            'paymentData' => ($this->paymentData ?? new MobilePaymentData())->toArray(),
            'paymentProductId' => $this->paymentProductId,
            'threeDSecureResults' => ($this->threeDSecureResults ?? new ThreeDSecureResults())->toArray(),
        ];
    }
}
