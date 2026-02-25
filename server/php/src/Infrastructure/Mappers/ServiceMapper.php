<?php

namespace OnlinePayments\ExampleApp\Infrastructure\Mappers;

use OnlinePayments\ExampleApp\Application\DTOs\Service\GetPaymentProductId\RequestDto as GetPaymentProductIdRequest;
use OnlinePayments\ExampleApp\Application\DTOs\Service\GetPaymentProductId\ResponseDto as GetPaymentProductIdResponse;
use OnlinePayments\Sdk\Domain\GetIINDetailsRequest;
use OnlinePayments\Sdk\Domain\GetIINDetailsResponse;

class ServiceMapper
{
    public static function toSdkRequest(GetPaymentProductIdRequest $requestDto): GetIINDetailsRequest
    {
        $request = new GetIINDetailsRequest();

        $request->setBin($requestDto->getCardNumber());

        return $request;
    }

    public static function toSdkResponse(GetIINDetailsResponse $responseDto): GetPaymentProductIdResponse
    {
        return new GetPaymentProductIdResponse($responseDto->getPaymentProductId());
    }
}