<?php

namespace OnlinePayments\ExampleApp\Infrastructure\Mappers;

use OnlinePayments\ExampleApp\Application\Domain\Enums\Common\Country;
use OnlinePayments\ExampleApp\Application\Domain\Payments\Mandate;
use OnlinePayments\ExampleApp\Application\DTOs\Mandate\GetMandateResponseDto;
use OnlinePayments\ExampleApp\Application\DTOs\Payment\RequestDto;
use OnlinePayments\ExampleApp\Application\Extensions\Models\CountryExtension;
use OnlinePayments\Sdk\Domain\BankAccountIban;
use OnlinePayments\Sdk\Domain\CreateMandateRequest;
use OnlinePayments\Sdk\Domain\CreateMandateResponse;
use OnlinePayments\Sdk\Domain\GetMandateResponse;
use OnlinePayments\Sdk\Domain\MandateAddress;
use OnlinePayments\Sdk\Domain\MandateCustomer;
use OnlinePayments\Sdk\Domain\MandatePersonalInformation;
use OnlinePayments\Sdk\Domain\MandatePersonalName;

final class MandateMapper
{
    public static function mapToCreateMandateRequest(?RequestDto $requestDto): CreateMandateRequest
    {
        $mandate = $requestDto?->mandate;

        $createMandate = new CreateMandateRequest();

        $customer = new MandateCustomer();

        $bankAccount = new BankAccountIban();
        $bankAccount->iban = $mandate?->iban;
        $customer->bankAccountIban = $bankAccount;

        $address = new MandateAddress();
        $address->countryCode = $mandate?->address?->country !== null
            ? CountryExtension::toIsoAlpha2(Country::tryFrom($mandate->address->country))
            : null;
        $address->city = $mandate?->address?->city;
        $address->street = $mandate?->address?->street;
        $address->zip = $mandate?->address?->zip;
        $customer->mandateAddress = $address;

        $personalInformation = new MandatePersonalInformation();
        $name = new MandatePersonalName();
        $name->firstName = $mandate?->address?->firstName;
        $name->surname = $mandate?->address?->lastName;
        $personalInformation->name = $name;
        $customer->personalInformation = $personalInformation;

        $createMandate->customer = $customer;
        $createMandate->customerReference = $mandate?->customerReference;
        $createMandate->recurrenceType = $mandate?->recurrenceType;
        $createMandate->returnUrl = $mandate?->returnUrl;
        $createMandate->signatureType = $mandate?->signatureType;

        return $createMandate;
    }

    public static function mapFromGetMandateResponse(?GetMandateResponse $getMandateResponse): ?GetMandateResponseDto
    {
        if ($getMandateResponse?->mandate === null) {
            return null;
        }

        return new GetMandateResponseDto($getMandateResponse->mandate->uniqueMandateReference);
    }

    public static function mapFromCreateMandateResponse(CreateMandateResponse $createMandateResponse): Mandate
    {
        $mandate = new Mandate();

        $mandate->iban = $createMandateResponse->mandate->customer->bankAccountIban->iban;
        $mandate->customerReference = $createMandateResponse->mandate->customerReference;
        $mandate->returnUrl = $createMandateResponse->merchantAction->redirectData->redirectURL;

        return $mandate;
    }
}
