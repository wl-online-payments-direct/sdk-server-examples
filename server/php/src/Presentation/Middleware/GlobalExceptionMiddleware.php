<?php

namespace OnlinePayments\ExampleApp\Presentation\Middleware;

use Fig\Http\Message\StatusCodeInterface;
use OnlinePayments\ExampleApp\Application\Exceptions\SdkException;
use OnlinePayments\ExampleApp\Presentation\Models\Errors\SystemErrorResponse;
use OnlinePayments\ExampleApp\Presentation\Models\Errors\ValidationErrorResponse;
use OnlinePayments\ExampleApp\Presentation\Extensions\ResponseExtension;
use OnlinePayments\ExampleApp\Configuration\Exceptions\ValidationException;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Log\LoggerInterface;
use Slim\Psr7\Request as SlimRequest;
use Slim\Psr7\Response as SlimResponse;
use InvalidArgumentException;

final readonly class GlobalExceptionMiddleware
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function __invoke(SlimRequest $request, RequestHandlerInterface $handler): SlimResponse
    {
        try {
            $responseFromHandler = $handler->handle($request);

            return ResponseExtension::toSlim($responseFromHandler);
        } catch (\Throwable $ex) {
            $this->logger->error('Exception occurred while processing request.', ['exception' => $ex]);

            [$statusCode, $errorResponse] = $this->mapExceptionToResponse($ex);

            $body = json_encode($errorResponse, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

            $response = new SlimResponse();
            $response->getBody()->write($body);

            return $response
                ->withStatus($statusCode)
                ->withHeader('Content-Type', 'application/problem+json');
        }
    }

    private function mapExceptionToResponse(\Throwable $ex): array
    {
        if ($ex instanceof SdkException) {
            return [
                $ex->getStatusCode(),
                new ValidationErrorResponse($ex->getMessage())
            ];
        }

        if ($ex instanceof InvalidArgumentException) {
            return [
                StatusCodeInterface::STATUS_BAD_REQUEST,
                new ValidationErrorResponse($ex->getMessage())
            ];
        }

        if ($ex instanceof ValidationException) {
            return [
                StatusCodeInterface::STATUS_BAD_REQUEST,
                new ValidationErrorResponse($ex->errors[0] ?? $ex->getMessage())
            ];
        }

        return [
            StatusCodeInterface::STATUS_INTERNAL_SERVER_ERROR,
            new SystemErrorResponse(
                StatusCodeInterface::STATUS_INTERNAL_SERVER_ERROR,
                'Internal Server Error.'
            )
        ];
    }
}
