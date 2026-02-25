<?php

namespace OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails;

final class CardPaymentMethodSpecificOutput
{
    public ?AcquirerInformation $acquirerInformation = null;
    public ?string $authorisationCode = null;
    public ?CardEssentials $card = null;
    public ?CardFraudResults $fraudResults = null;
    public ?string $paymentAccountReference = null;
    public ?int $paymentProductId = null;
    public ?ThreeDSecureResults $threeDSecureResults = null;
    public ?string $initialSchemeTransactionId = null;
    public ?string $schemeReferenceData = null;
    public ?string $token = null;
    public ?string $paymentOption = null;
    public ?ExternalTokenLinked $externalTokenLinked = null;
    public ?int $authenticatedAmount = null;
    public ?CurrencyConversion $currencyConversion = null;
    public ?PaymentProduct3208SpecificOutput $paymentProduct3208SpecificOutput = null;
    public ?PaymentProduct3209SpecificOutput $paymentProduct3209SpecificOutput = null;
    public ?ReattemptInstructions $reattemptInstructions = null;

    public function toArray(): array
    {
        return [
            'acquirerInformation' => $this->acquirerInformation?->toArray(),
            'authorisationCode' => $this->authorisationCode,
            'card' => $this->card?->toArray(),
            'fraudResults' => ($this->fraudResults ?? new FraudResults())->toArray(),
            'paymentAccountReference' => $this->paymentAccountReference,
            'paymentProductId' => $this->paymentProductId,
            'threeDSecureResults' => $this->threeDSecureResults?->toArray(),
            'initialSchemeTransactionId' => $this->initialSchemeTransactionId,
            'schemeReferenceData' => $this->schemeReferenceData,
            'token' => $this->token,
            'paymentOption' => $this->paymentOption,
            'externalTokenLinked' => ($this->externalTokenLinked ?? new ExternalTokenLinked())->toArray(),
            'authenticatedAmount' => $this->authenticatedAmount,
            'currencyConversion' => ($this->currencyConversion ?? new CurrencyConversion())->toArray(),
            'paymentProduct3208SpecificOutput' => ($this->paymentProduct3208SpecificOutput ?? new PaymentProduct3208SpecificOutput())->toArray(),
            'paymentProduct3209SpecificOutput' => ($this->paymentProduct3209SpecificOutput ?? new PaymentProduct3209SpecificOutput())->toArray(),
            'reattemptInstructions' => ($this->reattemptInstructions ?? new ReattemptInstructions())->toArray(),
        ];
    }
}
