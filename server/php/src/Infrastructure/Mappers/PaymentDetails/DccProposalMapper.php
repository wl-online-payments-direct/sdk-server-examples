<?php

namespace OnlinePayments\ExampleApp\Infrastructure\Mappers\PaymentDetails;

use OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails\DccProposal as DccProposalDto;
use OnlinePayments\Sdk\Domain\DccProposal as DccProposalSdk;

final class DccProposalMapper
{
    public static function mapFromSdkResponse(?DccProposalSdk $response): ?DccProposalDto
    {
        if ($response === null) {
            return null;
        }

        $dto = new DccProposalDto();
        $dto->rate = RateDetailsMapper::mapFromSdkResponse($response?->rate ?? null);
        $dto->baseAmount = AmountOfMoneyMapper::mapFromSdkResponse($response?->baseAmount ?? null);
        $dto->disclaimerDisplay = $response?->disclaimerDisplay ?? null;
        $dto->disclaimerReceipt = $response?->disclaimerReceipt ?? null;
        $dto->targetAmount = AmountOfMoneyMapper::mapFromSdkResponse($response?->targetAmount ?? null);

        return $dto;
    }
}
