<?php

namespace OnlinePayments\ExampleApp\Application\Domain\Payments;

use OnlinePayments\ExampleApp\Application\Domain\Enums\Payments\RecurrenceType;
use OnlinePayments\ExampleApp\Application\Domain\Enums\Payments\SignatureType;
use OnlinePayments\ExampleApp\Application\DTOs\Common\AddressDto;

class Mandate
{
    public ?string $iban = null;
    public ?string $customerReference = null;
    public ?string $mandateReference = null;

    public ?string $recurrenceType = null;
    public ?string $signatureType = null;

    public ?string $returnUrl = null;
    public ?AddressDto $address = null;

    public function __construct(
        ?string $iban = null,
        ?string $customerReference = null,
        ?string $mandateReference = null,
        ?string $recurrenceType = null,
        ?string $signatureType = null,
        ?string $returnUrl = null,
        ?AddressDto $address = null
    ) {
        $this->iban = $iban;
        $this->customerReference = $customerReference;
        $this->mandateReference = $mandateReference;
        $this->recurrenceType = $recurrenceType;
        $this->signatureType = $signatureType;
        $this->returnUrl = $returnUrl;
        $this->address = $address;
    }
}
