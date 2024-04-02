<?php

namespace MyApp\HostedCheckout;

use OnlinePayments\Sdk\Domain\AmountOfMoney;
use OnlinePayments\Sdk\Domain\CreateHostedCheckoutRequest;
use OnlinePayments\Sdk\Domain\HostedCheckoutSpecificInput;
use OnlinePayments\Sdk\Domain\Order;
use Slim\Psr7\Request;

/**
 * Hosted checkout mapper that converts Dtos into Domain classes
 * It provides also a conversion of the Request to the Dto classes
 */
class HostedCheckoutMapper
{

    public function toEmptyBasicDto()
    {
        $redirectUrl = $_ENV['HOSTED_CHECKOUT_REDIRECT_URL'];

        $emptyDto = new CreateHostedCheckoutBasicDto();
        $emptyDto->setRedirectUrl($redirectUrl);
    
        return $emptyDto;
    }

    public function toCreateHostedCheckoutRequest(CreateHostedCheckoutBasicDto $createHostedCheckoutBasicDto): CreateHostedCheckoutRequest {

        $createHostedCheckoutRequest = new CreateHostedCheckoutRequest();

        $order = new Order();

        $order->setAmountOfMoney(new AmountOfMoney());
        $order->getAmountOfMoney()->setAmount($this->toAmount($createHostedCheckoutBasicDto->getAmount()));
        $order->getAmountOfMoney()->setCurrencyCode($createHostedCheckoutBasicDto->getCurrency());

        $createHostedCheckoutRequest->setOrder($order);

        $createHostedCheckoutRequest->setHostedCheckoutSpecificInput(new HostedCheckoutSpecificInput());
        $createHostedCheckoutRequest->getHostedCheckoutSpecificInput()->setReturnUrl($createHostedCheckoutBasicDto->getRedirectUrl());

        return $createHostedCheckoutRequest;
    }

    public function toCreateHostedCheckoutBasicDto(Request $request): CreateHostedCheckoutBasicDto {
        $jsonString = $request->getBody();
        $requestData = json_decode($jsonString, true);
        $createHostedCheckoutBasicDto = new CreateHostedCheckoutBasicDto();

        $createHostedCheckoutBasicDto->setAmount($requestData['amount']);
        $createHostedCheckoutBasicDto->setCurrency($requestData['currency']);
        $createHostedCheckoutBasicDto->setRedirectUrl($requestData['redirectUrl']);

        return $createHostedCheckoutBasicDto;
    }

    private function toAmount($amount) {
        return (int) round($amount * 100);
    }
}