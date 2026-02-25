<?php

namespace OnlinePayments\ExampleApp\Infrastructure\Mappers\AdditionalPaymentActions;

use OnlinePayments\ExampleApp\Application\DTOs\AdditionalPaymentActions\RequestDto;
use OnlinePayments\Sdk\Domain\AmountOfMoney;

final class AmountOfMoneyMapper
{
    public static function mapAmountOfMoney(RequestDto $dto): ?AmountOfMoney
    {
        if (!isset($dto->amount) || $dto->currency === null) {
            return null;
        }

        $amountOfMoney = new AmountOfMoney();
        $amountOfMoney->amount = $dto->amount;
        $amountOfMoney->currencyCode = $dto->currency->value;

        return $amountOfMoney;
    }
}