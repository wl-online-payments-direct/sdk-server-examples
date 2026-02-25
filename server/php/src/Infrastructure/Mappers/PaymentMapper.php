<?php

namespace OnlinePayments\ExampleApp\Infrastructure\Mappers;

use OnlinePayments\ExampleApp\Application\Domain\Enums\AdditionalPaymentActions\Status;
use OnlinePayments\ExampleApp\Application\Domain\Enums\Common\Country;
use OnlinePayments\ExampleApp\Application\Domain\Enums\Common\StatusCategory;
use OnlinePayments\ExampleApp\Application\Domain\Enums\Payments\PaymentMethodType;
use OnlinePayments\ExampleApp\Application\Domain\Payments\StatusOutput;
use OnlinePayments\ExampleApp\Application\DTOs\Payment\RequestDto;
use OnlinePayments\ExampleApp\Application\DTOs\Payment\ResponseDto;
use OnlinePayments\ExampleApp\Application\Extensions\Models\CountryExtension;
use OnlinePayments\Sdk\Domain\Address as SdkAddress;
use OnlinePayments\Sdk\Domain\AmountOfMoney as SdkAmountOfMoney;
use OnlinePayments\Sdk\Domain\Card as SdkCard;
use OnlinePayments\Sdk\Domain\CardPaymentMethodSpecificInput as SdkCardPaymentSpecificInput;
use OnlinePayments\Sdk\Domain\CreatePaymentRequest as SdkCreatePaymentRequest;
use OnlinePayments\Sdk\Domain\CreatePaymentResponse as SdkCreatePaymentResponse;
use OnlinePayments\Sdk\Domain\Customer as SdkCustomer;
use OnlinePayments\Sdk\Domain\Order as SdkOrder;
use OnlinePayments\Sdk\Domain\PersonalInformation as SdkPersonalInformation;
use OnlinePayments\Sdk\Domain\PersonalName;
use OnlinePayments\Sdk\Domain\SepaDirectDebitPaymentMethodSpecificInput;
use OnlinePayments\Sdk\Domain\SepaDirectDebitPaymentProduct771SpecificInput;
use OnlinePayments\Sdk\Domain\Shipping as SdkShipping;
use OnlinePayments\Sdk\Domain\ThreeDSecure as SdkThreeDSecure;

final class PaymentMapper
{
    public static function mapToSdkRequest(RequestDto $requestDto): SdkCreatePaymentRequest
    {
        $sdkRequest = new SdkCreatePaymentRequest();

        $order = new SdkOrder();
        $amount = new SdkAmountOfMoney();
        $amount->setAmount($requestDto->amount !== null ? (int) $requestDto->amount : null);
        $amount->setCurrencyCode($requestDto->currency?->value ?? null);
        $order->setAmountOfMoney($amount);

        $customer = new SdkCustomer();
        $personal = new SdkPersonalInformation();

        $name = new PersonalName();
        $name->setFirstName($requestDto->billingAddress?->firstName ?? null);
        $name->setSurname($requestDto->billingAddress?->lastName ?? null);

        $personal->setName($name);
        $customer->setPersonalInformation($personal);

        $billing = new SdkAddress();
        $billing->setCity($requestDto->billingAddress?->city ?? null);
        $billing->setCountryCode(
            $requestDto->billingAddress?->country !== null
                ? CountryExtension::toIsoAlpha2(Country::tryFrom($requestDto->billingAddress->country))
                : null
        );
        $billing->setStreet($requestDto->billingAddress?->street ?? null);
        $billing->setZip($requestDto->billingAddress?->zip ?? null);
        $customer->setBillingAddress($billing);

        $order->setCustomer($customer);

        if ($requestDto->shippingAddress !== null) {
            $shipping = new SdkShipping();
            $shippingAddress = new SdkAddress();

            $shippingAddress->setCity($requestDto->shippingAddress->city ?? null);
            $shippingAddress->setCountryCode(
                $requestDto->shippingAddress->country !== null
                    ? CountryExtension::toIsoAlpha2(Country::tryFrom($requestDto->shippingAddress->country))
                    : null
            );

            $shippingAddress->setStreet($requestDto->shippingAddress->street ?? null);
            $shippingAddress->setZip($requestDto->shippingAddress->zip ?? null);

            $shipping->setAddress($shippingAddress);
            $order->setShipping($shipping);
        }

        $sdkRequest->setOrder($order);

        $method = $requestDto->method;

        if ($method === PaymentMethodType::CREDIT_CARD) {
            $cardInput = new SdkCardPaymentSpecificInput();
            $cardInput->setPaymentProductId($requestDto->paymentProductId);

            $sdkCard = new SdkCard();
            $sdkCard->setCardNumber($requestDto->card?->number ?? null);
            $sdkCard->setCardholderName($requestDto->card?->holderName ?? null);

            $expiryMonth = $requestDto->card?->expiryMonth ?? '';
            $expiryYear = $requestDto->card?->expiryYear ?? '';
            $yearSuffix = $expiryYear !== '' ? substr($expiryYear, -2) : '';
            $sdkCard->setExpiryDate($expiryMonth . $yearSuffix);

            $sdkCard->setCvv($requestDto->card?->verificationCode ?? null);

            $cardInput->setCard($sdkCard);

            $threeDs = new SdkThreeDSecure();
            $threeDs->setSkipAuthentication(true);
            $cardInput->setThreeDSecure($threeDs);

            $sdkRequest->setCardPaymentMethodSpecificInput($cardInput);
        }
        elseif ($method === PaymentMethodType::TOKEN) {
            $sdkRequest->setHostedTokenizationId($requestDto->hostedTokenizationId ?? null);

            $cardInput = new SdkCardPaymentSpecificInput();
            $threeDs = new SdkThreeDSecure();
            $threeDs->setSkipAuthentication(true);
            $cardInput->setThreeDSecure($threeDs);
            $sdkRequest->setCardPaymentMethodSpecificInput($cardInput);
        }
        elseif ($method === PaymentMethodType::DIRECT_DEBIT) {
            $sepa = new SepaDirectDebitPaymentMethodSpecificInput();
            $sepa->setPaymentProductId($requestDto->paymentProductId);

            $specific771 = new SepaDirectDebitPaymentProduct771SpecificInput();
            $specific771->setExistingUniqueMandateReference(
                $requestDto->mandate?->mandateReference
            );

            $sepa->setPaymentProduct771SpecificInput($specific771);
            $sdkRequest->setSepaDirectDebitPaymentMethodSpecificInput($sepa);
        }

        return $sdkRequest;
    }

    public static function mapFromSdkResponse(?SdkCreatePaymentResponse $response): ResponseDto
    {
        $payment = $response?->getPayment();

        $status = null;

        $statusString = $payment?->getStatus();

        if ($statusString !== null) {
            $status = Status::tryFrom(strtoupper($statusString));
        }

        $statusOutputObj = $payment?->getStatusOutput();
        if ($statusOutputObj !== null) {
            $statusCode = $statusOutputObj->getStatusCode();
            $statusCategoryString = $statusOutputObj->getStatusCategory();
            $statusCategory = $statusCategoryString !== null ? StatusCategory::tryFrom(strtoupper($statusCategoryString)) : null;

            $statusOutput = new StatusOutput(
                $statusCode,
                $statusCategory
            );
        }
        else {
            $statusOutput = new StatusOutput(null, null);
        }

        return new ResponseDto(
            $payment?->getId() ?? null,
            $status,
            $statusOutput
        );
    }
}
