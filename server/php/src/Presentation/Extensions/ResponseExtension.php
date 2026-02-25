<?php

namespace OnlinePayments\ExampleApp\Presentation\Extensions;

use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Response as SlimResponse;
use OnlinePayments\ExampleApp\Application\Interfaces\Responses\ResponseInterface as ResponseInterfaceModel;

final class ResponseExtension
{
    public static function toSlim(ResponseInterface $responseFromHandler): SlimResponse
    {
        $slimResponse = new SlimResponse();

        $slimResponse->getBody()->write((string)$responseFromHandler->getBody());

        foreach ($responseFromHandler->getHeaders() as $name => $values) {
            foreach ($values as $value) {
                $slimResponse = $slimResponse->withHeader($name, $value);
            }
        }

        return $slimResponse->withStatus($responseFromHandler->getStatusCode());
    }

    public static function createSlimResponse(ResponseInterfaceModel $responseModel, int $status = 200): SlimResponse
    {
        $slimResponse = new SlimResponse();
        $slimResponse->getBody()->write(json_encode($responseModel->toArray(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));

        return $slimResponse
            ->withStatus($status)
            ->withHeader('Content-Type', 'application/json');
    }
}
