<?php
namespace MyApp\HostedCheckout;
use JsonSerializable;

/**
 * Basic Dto for Create Hosted Checkout
 */
class CreateHostedCheckoutBasicDto implements JsonSerializable
{
    private $amount;
    private $currency;
    private $redirectUrl;

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

    public function getRedirectUrl() {
        return $this->redirectUrl;
    }

    public function setRedirectUrl($redirectUrl) {
        $this->redirectUrl = $redirectUrl;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'amount' => $this->amount,
            'currency' => $this->currency,
            'redirectUrl' => $this->redirectUrl
        ];
    }
}