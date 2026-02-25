<?php

namespace OnlinePayments\ExampleApp\Infrastructure\Mappers;

use OnlinePayments\ExampleApp\Application\Exceptions\SdkException;
use OnlinePayments\Sdk\ApiException;
use OnlinePayments\Sdk\DeclinedPaymentException;
use OnlinePayments\Sdk\ReferenceException;
use OnlinePayments\Sdk\ValidationException;
use OnlinePayments\Sdk\AuthorizationException;

class ExceptionMapper
{
    public static function map(\Exception $exception, ?string $customMessage = null): SdkException
    {
        if ($exception instanceof ValidationException) {
            return self::mapValidationException($exception);
        }

        if ($exception instanceof AuthorizationException) {
            return self::mapAuthorizationException($exception);
        }

        if ($exception instanceof ApiException
            || $exception instanceof DeclinedPaymentException
            || $exception instanceof ReferenceException) {
            return self::mapSdkErrorException($exception, $customMessage);
        }

        return new SdkException('An unexpected error occurred.', 500, $exception);
    }

    private static function mapValidationException(ValidationException $exception): SdkException
    {
        $message = self::extractValidationMessage($exception);
        return new SdkException($message, 400, $exception);
    }

    private static function mapAuthorizationException(AuthorizationException $exception): SdkException
    {
        return new SdkException('Invalid merchant data.', 403, $exception);
    }

    private static function mapSdkErrorException(\Exception $exception, ?string $customMessage = null): SdkException
    {
        $message = $customMessage ?? self::extractMessageFromSdkException($exception);
        $statusCode = self::extractStatusCodeFromSdkException($exception);

        return new SdkException($message, $statusCode, $exception);
    }

    private static function extractMessageFromSdkException(\Exception $exception): string
    {
        try {
            if (method_exists($exception, 'getErrors')) {
                $errors = $exception->getErrors();

                if (!empty($errors) && is_array($errors)) {
                    $firstError = $errors[0];

                    if (!empty($firstError->id)) {
                        return $firstError->id;
                    }

                    if (!empty($firstError->message)) {
                        return $firstError->message;
                    }

                    if (!empty($firstError->category) || !empty($firstError->errorCode)) {
                        return sprintf('%s (%s)', $firstError->category ?? '', $firstError->errorCode ?? '');
                    }
                }
            }

            return $exception->getMessage();
        } catch (\Exception $e) {
            return 'Error could not be retrieved.';
        }
    }

    private static function extractStatusCodeFromSdkException(\Exception $exception): int
    {
        try {
            if (method_exists($exception, 'getErrors')) {
                $errors = $exception->getErrors();

                if (!empty($errors) && is_array($errors)) {
                    $firstError = $errors[0];
                    $status = $firstError->httpStatusCode ?? 0;

                    if ($status > 0) {
                        return $status;
                    }
                }
            }

            return 422;
        } catch (\Exception $e) {
            return 422;
        }
    }

    private static function extractValidationMessage(ValidationException $exception): string
    {
        try {
            if (method_exists($exception, 'getErrors')) {
                $errors = $exception->getErrors();

                if (!empty($errors) && is_array($errors)) {
                    foreach ($errors as $error) {
                        if (!empty($error->id)) {
                            return $error->id;
                        }

                        if (!empty($error->message)) {
                            return $error->message;
                        }
                    }
                }
            }

            return $exception->getMessage();
        } catch (\Exception $e) {
            return 'Validation error occurred.';
        }
    }
}
