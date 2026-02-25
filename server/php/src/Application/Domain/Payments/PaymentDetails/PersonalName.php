<?php

namespace OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails;

final class PersonalName
{
    public ?string $firstName;
    public ?string $surname;
    public ?string $title;

    public function __construct(?string $firstName = null, ?string $surname = null, ?string $title = null)
    {
        $this->firstName = $firstName;
        $this->surname = $surname;
        $this->title = $title;
    }

    public function toArray(): array
    {
        return [
            'firstName' => $this->firstName,
            'surname' => $this->surname,
            'title' => $this->title,
        ];
    }
}
