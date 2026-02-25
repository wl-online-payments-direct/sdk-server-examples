<?php

namespace OnlinePayments\ExampleApp\Presentation\Models\Payment;

use OnlinePayments\ExampleApp\Application\Domain\Payments\Card;
use OnlinePayments\ExampleApp\Application\Domain\Payments\Mandate;
use OnlinePayments\ExampleApp\Application\DTOs\Common\AddressDto;
use Slim\Psr7\Request as SlimRequest;

class Request
{
    public ?float $amount;
    public ?string $currency = null;
    public ?string $method = null;
    public ?string $hostedTokenizationId = null;

    public ?AddressDto $shippingAddress = null;
    public ?AddressDto $billingAddress = null;
    public ?Card $card = null;
    public ?Mandate $mandate = null;

    public function __construct(
        ?float $amount = null,
        ?string $currency = null,
        ?string $method = null,
        ?string $hostedTokenizationId = null,
        ?AddressDto $shippingAddress = null,
        ?AddressDto $billingAddress = null,
        ?Card $card = null,
        ?Mandate $mandate = null
    ) {
        $this->amount = $amount;
        $this->currency = $currency;
        $this->method = $method;
        $this->hostedTokenizationId = $hostedTokenizationId;
        $this->shippingAddress = $shippingAddress ;
        $this->billingAddress = $billingAddress;
        $this->card = $card;
        $this->mandate = $mandate;
    }

    public static function fromRequest(SlimRequest $request): self
    {
        $data = json_decode((string)$request->getBody(), true) ?: [];

        $amount = $data['amount'] ?? null;

        if ($amount !== null && !is_numeric($amount) && $amount !== '') {
            throw new \InvalidArgumentException('The Amount field must be a number.');
        }
        elseif ($amount === '') {
            throw new \InvalidArgumentException('The Amount field is required.');
        }

        $currency = array_key_exists('currency', $data) ? (string)$data['currency'] : null;
        $method = array_key_exists('method', $data) ? (string)$data['method'] : null;

        return new self(
            $amount,
            $currency,
            $method,
            $data['hostedTokenizationId'] ?? null,
            isset($data['shippingAddress']) ? AddressDto::fromArray($data['shippingAddress']) : null,
            isset($data['billingAddress']) ? AddressDto::fromArray($data['billingAddress']) : null,
            isset($data['card']) ? new Card(
                number: $data['card']['number'] ?? null,
                holderName: $data['card']['holderName'] ?? null,
                verificationCode: $data['card']['verificationCode'] ?? null,
                expiryMonth: $data['card']['expiryMonth'] ?? null,
                expiryYear: $data['card']['expiryYear'] ?? null,
            ) : null,
            isset($data['mandate']) ? new Mandate(
                iban: $data['mandate']['iban'] ?? null,
                customerReference: $data['mandate']['customerReference'] ?? null,
                mandateReference: $data['mandate']['mandateReference'] ?? null,
                recurrenceType: $data['mandate']['recurrenceType'] ?? null,
                signatureType: $data['mandate']['signatureType'] ?? null,
                returnUrl: $data['mandate']['returnUrl'] ?? null,
                address: isset($data['mandate']['address']) ? AddressDto::fromArray($data['mandate']['address']) : null,
            ) : null
        );
    }

    public function toArray(): array
    {
        return [
            'amount' => $this->amount,
            'currency' => $this->currency,
            'method' => $this->method,
            'hostedTokenizationId' => $this->hostedTokenizationId,
            'shippingAddress' => $this->shippingAddress?->toArray(),
            'billingAddress' => $this->billingAddress?->toArray(),
            'card' => $this->card ? [
                'number' => $this->card->number,
                'holderName' => $this->card->holderName,
                'verificationCode' => $this->card->verificationCode,
                'expiryMonth' => $this->card->expiryMonth,
                'expiryYear' => $this->card->expiryYear,
            ] : null,
            'mandate' => $this->mandate ? [
                'iban' => $this->mandate->iban,
                'customerReference' => $this->mandate->customerReference,
                'mandateReference' => $this->mandate->mandateReference,
                'recurrenceType' => $this->mandate->recurrenceType,
                'signatureType' => $this->mandate->signatureType,
                'returnUrl' => $this->mandate->returnUrl,
                'address' => $this->mandate->address?->toArray(),
            ] : null,
        ];
    }
}
