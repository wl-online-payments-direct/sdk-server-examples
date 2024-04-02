<?php
namespace MyApp\HostedTokenization;
use JsonSerializable;

/**
 * Basic Dto for creating a Hosted Tokenization
 */
class CreateHostedTokenizationBasicDto implements JsonSerializable
{
    private $amount;
    private $currency;
    private $hostedTokenizationId;

    public function getAmount() {
        return $this->amount;
    }

    public function setAmount($amount) {
        $this->amount = $amount;
    }

    public function getCurrency() {
        return $this->currency;
    }

    public function setCurrency($currency) {
        $this->currency = $currency;
    }

    public function getHostedTokenizationId() {
        return $this->hostedTokenizationId;
    }

    public function setHostedTokenizationId($hostedTokenizationId) {
        $this->hostedTokenizationId = $hostedTokenizationId;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'amount' => $this->amount,
            'currency' => $this->currency,
            'hostedTokenizationId' => $this->hostedTokenizationId
        ];
    }
}