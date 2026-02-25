<?php

namespace OnlinePayments\ExampleApp\Presentation\Models\HostedCheckout;

use OnlinePayments\ExampleApp\Application\DTOs\Common\AddressDto;
use Slim\Psr7\Request as SlimRequest;

class Request
{
    public ?float $amount;
    public ?string $currency;
    public ?string $language = null;
    public ?string $redirectUrl = null;
    public ?AddressDto $billingAddress = null;
    public ?AddressDto $shippingAddress = null;

    public function __construct(
        ?float $amount,
        ?string $currency,
        ?string $language = null,
        ?string $redirectUrl = null,
        ?AddressDto $billingAddress = null,
        ?AddressDto $shippingAddress = null
    ) {
        $this->amount = $amount;
        $this->currency = $currency;
        $this->language = $language;
        $this->redirectUrl = $redirectUrl;
        $this->billingAddress = $billingAddress;
        $this->shippingAddress = $shippingAddress;
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
        $language = array_key_exists('language', $data) ? (string)$data['language'] : null;

        return new self(
            $amount,
            $currency,
            $language,
            $data['redirectUrl'] ?? null,
            AddressDto::fromArray($data['billingAddress'] ?? []),
            AddressDto::fromArray($data['shippingAddress'] ?? [])
        );
    }

    public function toArray(): array
    {
        return [
            'amount' => $this->amount,
            'currency' => $this->currency,
            'language' => $this->language,
            'redirectUrl' => $this->redirectUrl,
            'billingAddress' => $this->billingAddress?->toArray(),
            'shippingAddress' => $this->shippingAddress?->toArray(),
        ];
    }
}
