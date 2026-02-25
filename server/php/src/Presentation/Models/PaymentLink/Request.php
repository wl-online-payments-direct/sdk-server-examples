<?php

namespace OnlinePayments\ExampleApp\Presentation\Models\PaymentLink;

use Slim\Psr7\Request as SlimRequest;

class Request
{
    public ?float $amount;
    public ?string $currency;
    public ?string $description = null;
    public ?string $validFor;
    public ?string $action;

    public function __construct(
        ?float $amount,
        ?string $currency,
        ?string $validFor,
        ?string $action,
        ?string $description = null
    ) {
        $this->amount = $amount;
        $this->currency = $currency;
        $this->validFor = $validFor;
        $this->action = $action;
        $this->description = $description;
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
        $validFor = array_key_exists('validFor', $data) ? (string)$data['validFor'] : null;
        $action = array_key_exists('action', $data) ? (string)$data['action'] : null;
        $description = array_key_exists('description', $data) ? (string)$data['description'] : null;

        return new self(
            $amount,
            $currency,
            $validFor,
            $action,
            $description
        );
    }
    public function toArray(): array
    {
        return [
            'amount' => $this->amount,
            'currency' => $this->currency,
            'validFor' => $this->validFor,
            'action' => $this->action,
            'description' => $this->description,
        ];
    }
}
