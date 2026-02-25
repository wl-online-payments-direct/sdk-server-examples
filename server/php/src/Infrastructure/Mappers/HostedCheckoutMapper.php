<?php

namespace OnlinePayments\ExampleApp\Infrastructure\Mappers;

use OnlinePayments\ExampleApp\Application\Domain\Enums\Common\Country;
use OnlinePayments\ExampleApp\Application\DTOs\HostedCheckout\RequestDto as CreateHostedCheckoutRequestDto;
use OnlinePayments\ExampleApp\Application\DTOs\HostedCheckout\ResponseDto as CreateHostedCheckoutResponseDto;
use OnlinePayments\ExampleApp\Application\Extensions\Models\CountryExtension;
use OnlinePayments\ExampleApp\Application\Extensions\Models\LanguageExtensions;
use OnlinePayments\Sdk\Domain\Address;
use OnlinePayments\Sdk\Domain\AddressPersonal;
use OnlinePayments\Sdk\Domain\AmountOfMoney;
use OnlinePayments\Sdk\Domain\CreateHostedCheckoutRequest;
use OnlinePayments\Sdk\Domain\CreateHostedCheckoutResponse;
use OnlinePayments\Sdk\Domain\Customer;
use OnlinePayments\Sdk\Domain\GetHostedCheckoutResponse;
use OnlinePayments\ExampleApp\Application\DTOs\GetPaymentByHostedCheckoutId\ResponseDto as GetPaymentByHostedCheckoutIdResponseDto;
use OnlinePayments\Sdk\Domain\HostedCheckoutSpecificInput;
use OnlinePayments\Sdk\Domain\Order;
use OnlinePayments\Sdk\Domain\PersonalInformation;
use OnlinePayments\Sdk\Domain\PersonalName;
use OnlinePayments\Sdk\Domain\Shipping;

class HostedCheckoutMapper
{
    public static function mapToSdkRequest(CreateHostedCheckoutRequestDto $requestDto): CreateHostedCheckoutRequest
    {
        $sdkRequest = new CreateHostedCheckoutRequest();

        $order = new Order();

        $amount = new AmountOfMoney();
        $amount->setAmount($requestDto->amount);
        $amount->setCurrencyCode($requestDto->currency->value);
        $order->setAmountOfMoney($amount);

        $customer = new Customer();

        if ($requestDto->billingAddress !== null) {
            $personalInformation = new PersonalInformation();
            $name = new PersonalName();
            $name->setFirstName($requestDto->billingAddress->firstName);
            $name->setSurname($requestDto->billingAddress->lastName);
            $personalInformation->setName($name);
            $customer->setPersonalInformation($personalInformation);

            $billingAddress = new Address();
            $billingAddress->setCity($requestDto->billingAddress->city);
            $billingCountry = is_string($requestDto->billingAddress->country)
                ? Country::from($requestDto->billingAddress->country)
                : $requestDto->billingAddress->country;
            $billingAddress->setCountryCode(CountryExtension::toIsoAlpha2($billingCountry));
            $billingAddress->setStreet($requestDto->billingAddress->street);
            $billingAddress->setZip($requestDto->billingAddress->zip);
            $customer->setBillingAddress($billingAddress);
        }

        $order->setCustomer($customer);

        if ($requestDto->shippingAddress !== null) {
            $shipping = new Shipping();
            $shippingAddress = new AddressPersonal();
            $shippingAddress->setCity($requestDto->shippingAddress->city);
            $shippingCountry = is_string($requestDto->shippingAddress->country)
                ? Country::from($requestDto->shippingAddress->country)
                : $requestDto->shippingAddress->country;
            $shippingAddress->setCountryCode(CountryExtension::toIsoAlpha2($shippingCountry));
            $shippingAddress->setStreet($requestDto->shippingAddress->street);
            $shippingAddress->setZip($requestDto->shippingAddress->zip);

            $shippingName = new PersonalName();
            $shippingName->setFirstName($requestDto->shippingAddress->firstName);
            $shippingName->setSurname($requestDto->shippingAddress->lastName);
            $shippingAddress->setName($shippingName);

            $shipping->setAddress($shippingAddress);
            $order->setShipping($shipping);
        }

        $sdkRequest->setOrder($order);

        $billingCountry = $requestDto->billingAddress?->country;
        if (is_string($billingCountry)) {
            $billingCountry = Country::from($billingCountry);
        }

        $hostedCheckoutSpecificInput = new HostedCheckoutSpecificInput();
        $hostedCheckoutSpecificInput->setReturnUrl($requestDto->redirectUrl);
        $hostedCheckoutSpecificInput->setLocale(
            LanguageExtensions::toLocale(
                $requestDto->language,
                $billingCountry
            )
        );

        $sdkRequest->setHostedCheckoutSpecificInput($hostedCheckoutSpecificInput);

        return $sdkRequest;
    }

    public static function mapFromSdkResponse(CreateHostedCheckoutResponse $sdkResponse): CreateHostedCheckoutResponseDto
    {
        return new CreateHostedCheckoutResponseDto(
            hostedCheckoutId: $sdkResponse->getHostedCheckoutId(),
            redirectUrl: $sdkResponse->getRedirectUrl(),
            returnMAC: $sdkResponse->getRETURNMAC()
        );
    }

    public static function mapFromSdkGetPaymentResponse(?GetHostedCheckoutResponse $response): GetPaymentByHostedCheckoutIdResponseDto
    {
        $responseDto = new GetPaymentByHostedCheckoutIdResponseDto();
        $responseDto->status = $response?->status ?? null;
        $responseDto->paymentId = $response?->createdPaymentOutput?->payment?->id ?? null;

        return $responseDto;
    }
}
