<?php

namespace OnlinePayments\ExampleApp\Presentation\Extensions;

use OnlinePayments\Sdk\Domain\APIError;
use OnlinePayments\Sdk\ReferenceException;
use Throwable;

final class ExceptionExtension
{
    public static function composeErrorMessage(?APIError $e): string
    {
        if ($e === null) {
            return 'Internal platform error.';
        }

        if (!empty($e->id)) {
            return $e->id;
        }

        if (!empty($e->message)) {
            return $e->message;
        }

        return sprintf('%s (%s)', $e->category ?? 'UNKNOWN', $e->errorCode ?? 'UNKNOWN');
    }

    public static function extractFirstApiError(Throwable $ex): ?APIError
    {
        if (method_exists($ex, 'getResponse')) {
            try {
                $response = $ex->getResponse();
                if ($response !== null && method_exists($response, 'getErrors')) {
                    $errors = $response->getErrors();
                    if (!empty($errors) && is_array($errors)) {
                        return $errors[0];
                    }
                }
            } catch (Throwable) {
                return null;
            }
        }

        if (method_exists($ex, 'getErrors')) {
            try {
                $errors = $ex->getErrors();
                if (!empty($errors) && is_array($errors)) {
                    return $errors[0];
                }
            } catch (Throwable) {
                return null;
            }
        }

        return null;
    }

    public static function extractMessageFromReferenceException(ReferenceException $ex): ?string
    {
        if (method_exists($ex, 'getResponse')) {
            try {
                $response = $ex->getResponse();
                if ($response !== null && method_exists($response, 'getErrors')) {
                    $errors = $response->getErrors();
                    if (!empty($errors) && is_array($errors)) {
                        $first = $errors[0];
                        if (is_object($first)) {
                            if (!empty($first->message)) {
                                return $first->message;
                            }

                            if (!empty($first->id)) {
                                return $first->id;
                            }
                        }
                    }
                }
            } catch (Throwable) {
                return null;
            }
        }

        return $ex->getMessage() ?: null;
    }
}
