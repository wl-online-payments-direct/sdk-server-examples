<?php
namespace MyApp\Payment;
use JsonSerializable;

/**
 * Basic dto used for creating a payment request
 */
class CreatePaymentBasicDto implements JsonSerializable
{
    private $cardNumber;
    private $cardHolder;
    private $expiryMonth;
    private $expiryYear;
    private $cvv;
    private $amount;
    private $currency;

    public function getCardNumber()
    {
        return $this->cardNumber;
    }

    public function setCardNumber($cardNumber)
    {
        $this->cardNumber = $cardNumber;
    }

    public function getCardHolder()
    {
        return $this->cardHolder;
    }

    public function setCardHolder($cardHolder)
    {
        $this->cardHolder = $cardHolder;
    }

    public function getExpiryMonth()
    {
        return $this->expiryMonth;
    }

    public function setExpiryMonth($expiryMonth)
    {
        $this->expiryMonth = $expiryMonth;
    }

    public function getExpiryYear()
    {
        return $this->expiryYear;
    }

    public function setExpiryYear($expiryYear)
    {
        $this->expiryYear = $expiryYear;
    }

    public function getCvv()
    {
        return $this->cvv;
    }

    public function setCvv($cvv)
    {
        $this->cvv = $cvv;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'cardNumber' => $this->cardNumber,
            'cardHolder' => $this->cardHolder,
            'expiryMonth' => $this->expiryMonth,
            'expiryYear' => $this->expiryYear,
            'cvv' => $this->cvv,
            'amount' => $this->amount,
            'currency' => $this->currency
        ];
    }
}