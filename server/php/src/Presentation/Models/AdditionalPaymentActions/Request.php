<?php

namespace OnlinePayments\ExampleApp\Presentation\Models\AdditionalPaymentActions;

use Slim\Psr7\Request as SlimRequest;

final class Request
{
    public ?float $amount = null;
    public ?string $currency = null;
    public ?bool $isFinal = null;

    public function __construct(
        ?float $amount = null,
        ?string $currency = null,
        ?bool $isFinal = null
    ) {
        $this->amount = $amount;
        $this->currency = $currency;
        $this->isFinal = $isFinal;
    }

    public static function fromRequest(SlimRequest $request): self
    {
        $data = json_decode((string) $request->getBody(), true) ?: [];

        $amount = $data['amount'] ?? null;

        if ($amount !== null && !is_numeric($amount) && $amount !== '') {
            throw new \InvalidArgumentException('The Amount field must be a number.');
        }
        elseif ($amount === '') {
            throw new \InvalidArgumentException('The Amount field is required.');
        }

        $currency = array_key_exists('currency', $data)
            ? $data['currency']
            : null;

        $isFinal = array_key_exists('isFinal', $data)
            ? (bool) $data['isFinal']
            : null;

        return new self(
            $amount,
            $currency,
            $isFinal
        );
    }

    public function toArray(): array
    {
        return [
            'amount' => $this->amount,
            'currency' => $this->currency,
            'isFinal' => $this->isFinal,
        ];
    }
}
