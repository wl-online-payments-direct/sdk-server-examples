<?php

namespace MyApp\HostedTokenization;

use OnlinePayments\Sdk\Domain\AmountOfMoney;
use OnlinePayments\Sdk\Domain\BrowserData;
use OnlinePayments\Sdk\Domain\CardPaymentMethodSpecificInput;
use OnlinePayments\Sdk\Domain\CreatePaymentRequest;
use OnlinePayments\Sdk\Domain\Customer;
use OnlinePayments\Sdk\Domain\CustomerDevice;
use OnlinePayments\Sdk\Domain\Order;
use Slim\Psr7\Request;

/**
 * Hosted tokenization mapper that converts Dtos into Domain classes
 * It provides also a conversion of the Request to the Dto classes
 */
class HostedTokenizationMapper
{
    public function toHostedTokenizationPaymentRequest(CreateHostedTokenizationBasicDto $createHostedTokenizationBasicDto): CreatePaymentRequest {

        $createPaymentRequest = new CreatePaymentRequest();

        $cardPaymentMethodSpecificInput = new CardPaymentMethodSpecificInput();
        $cardPaymentMethodSpecificInput->setAuthorizationMode("SALE");

        $createPaymentRequest->setCardPaymentMethodSpecificInput($cardPaymentMethodSpecificInput);

        $createPaymentRequest->setHostedTokenizationId($createHostedTokenizationBasicDto->getHostedTokenizationId());

        $order = new Order();

        $order->setAmountOfMoney(new AmountOfMoney());
        $order->getAmountOfMoney()->setAmount($this->toAmount($createHostedTokenizationBasicDto->getAmount()));
        $order->getAmountOfMoney()->setCurrencyCode($createHostedTokenizationBasicDto->getCurrency());

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

    public function toCreateHostedTokenizationBasicDto(Request $request): CreateHostedTokenizationBasicDto {
        $jsonString = $request->getBody();
        $requestData = json_decode($jsonString, true);
        $createHostedTokenizationBasicDto = new CreateHostedTokenizationBasicDto();

        $createHostedTokenizationBasicDto->setAmount($requestData['amount']);
        $createHostedTokenizationBasicDto->setCurrency($requestData['currency']);
        $createHostedTokenizationBasicDto->setHostedTokenizationId($requestData['hostedTokenizationId']);

        return $createHostedTokenizationBasicDto;
    }

    private function toAmount($amount) {
        return (int) round($amount * 100);
    }
}