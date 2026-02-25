<?php

namespace OnlinePayments\ExampleApp\Infrastructure\Mappers\PaymentDetails;

use OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails\CardEssentials as CardEssentialsDto;
use OnlinePayments\Sdk\Domain\CardEssentials as CardEssentialsSdk;

final class CardEssentialsMapper
{
    public static function mapFromSdkResponse(?CardEssentialsSdk $response): ?CardEssentialsDto
    {
        if ($response === null) {
            return null;
        }

        $dto = new CardEssentialsDto();
        $dto->countryCode = $response?->countryCode ?? null;
        $dto->cardNumber = $response?->cardNumber ?? null;
        $dto->expiryDate = $response?->expiryDate ?? null;
        $dto->bin = $response?->bin ?? null;

        return $dto;
    }
}
