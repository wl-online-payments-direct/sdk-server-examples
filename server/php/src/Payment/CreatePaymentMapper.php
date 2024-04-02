<?php

namespace MyApp\Payment;

use MyApp\Payment\CreatePaymentBasicDto;
use OnlinePayments\Sdk\Domain\AmountOfMoney;
use OnlinePayments\Sdk\Domain\BrowserData;
use OnlinePayments\Sdk\Domain\Card;
use OnlinePayments\Sdk\Domain\CardPaymentMethodSpecificInput;
use OnlinePayments\Sdk\Domain\CreatePaymentRequest;
use OnlinePayments\Sdk\Domain\Customer;
use OnlinePayments\Sdk\Domain\CustomerDevice;
use OnlinePayments\Sdk\Domain\Order;
use Slim\Psr7\Request;

/**
 * Create payment mapper that converts Dtos into Domain classes
 * It provides also a conversion of the Request to the Dto classes
 */
class CreatePaymentMapper
{
    public function toEmptyBasicDto()
    {
        $emptyBasicDto = new CreatePaymentBasicDto();
        $emptyBasicDto->setCardNumber("4012000033330026");
        $emptyBasicDto->setCardHolder("Willie E. Coyote");
        $emptyBasicDto->setExpiryMonth("05");
        $emptyBasicDto->setExpiryYear("29");
        $emptyBasicDto->setCvv("123");
    
        return $emptyBasicDto;
    }

    public function toCreatePaymentRequest(CreatePaymentBasicDto $createPaymentBasicDto): CreatePaymentRequest {

        $createPaymentRequest = new CreatePaymentRequest();

        $cardPaymentMethodSpecificInput = new CardPaymentMethodSpecificInput();

        $cardPaymentMethodSpecificInput->setCard(new Card());
        $cardPaymentMethodSpecificInput->getCard()->setCardNumber($createPaymentBasicDto->getCardNumber());
        $cardPaymentMethodSpecificInput->getCard()->setCardholderName($createPaymentBasicDto->getCardHolder());
        $cardPaymentMethodSpecificInput->getCard()->setExpiryDate($createPaymentBasicDto->getExpiryMonth() . $createPaymentBasicDto->getExpiryYear());
        $cardPaymentMethodSpecificInput->getCard()->setCvv($createPaymentBasicDto->getCvv());
        
        $cardPaymentMethodSpecificInput->setPaymentProductId(1);

        $createPaymentRequest->setCardPaymentMethodSpecificInput($cardPaymentMethodSpecificInput);

        $order = new Order();

        $order->setAmountOfMoney(new AmountOfMoney());
        $order->getAmountOfMoney()->setAmount($this->toAmount($createPaymentBasicDto->getAmount()));
        $order->getAmountOfMoney()->setCurrencyCode($createPaymentBasicDto->getCurrency());

        $customer = new Customer();
        $customer->setDevice(new CustomerDevice());
        $customer->getDevice()->setAcceptHeader("texthtml,application/xhtml+xml,application/xml;q=0.9,/;q=0.8");
        $customer->getDevice()->setBrowserData(new BrowserData());
        $customer->getDevice()->getBrowserData()->setColorDepth(24);
        $customer->getDevice()->getBrowserData()->setJavaEnabled(false);
        $customer->getDevice()->getBrowserData()->setScreenHeight("1200");
        $customer->getDevice()->getBrowserData()->setScreenWidth("1920");
        $customer->getDevice()->setIpAddress("123.123.123.123");
        $customer->getDevice()->setLocale("en_GB");
        $customer->getDevice()->setUserAgent("Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_4) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/12.1 Safari/605.1.15");
        $customer->getDevice()->setTimezoneOffsetUtcMinutes("420");
        
        $order->setCustomer($customer);

        $createPaymentRequest->setOrder($order);

        return $createPaymentRequest;
    }

    public function toCreatePaymentBasicDto(Request $request): CreatePaymentBasicDto {
        $jsonString = $request->getBody();
        $requestData = json_decode($jsonString, true);
        $createPaymentBasicDto = new CreatePaymentBasicDto();

        $createPaymentBasicDto->setCardNumber($requestData['cardNumber']);
        $createPaymentBasicDto->setCardHolder($requestData['cardHolder']);
        $createPaymentBasicDto->setExpiryMonth($requestData['expiryMonth']);
        $createPaymentBasicDto->setExpiryYear($requestData['expiryYear']);
        $createPaymentBasicDto->setCvv($requestData['cvv']);
        $createPaymentBasicDto->setAmount($requestData['amount']);
        $createPaymentBasicDto->setCurrency($requestData['currency']);

        return $createPaymentBasicDto;
    }

    private function toAmount($amount) {
        return (int) round($amount * 100);
    }
}