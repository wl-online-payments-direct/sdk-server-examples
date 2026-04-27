import { FastifyError, FastifyReply, FastifyRequest } from 'fastify';
import { ValidationError } from '../../business/errors/validation-error';
import { ConfigurationError } from '../../configuration/errors/configuration-error';
import { SdkResponseError } from '../../business/errors/sdk-response-error';

export function globalErrorHandler(error: FastifyError | Error, request: FastifyRequest, reply: FastifyReply): void {
    request.log.error(error, 'Error occurred while processing request.');

    const [statusCode, errorResponse] = mapExceptionToResponse(error);

    reply.code(statusCode).header('Content-Type', 'application/problem+json').send(errorResponse);
}

function mapExceptionToResponse(ex: Error | FastifyError): [number, any] {
    // PlatformException (5xx errors from SDK)
    if (ex instanceof SdkResponseError && ex.statusCode >= 500) {
        return [
            500,
            {
                code: 500,
                description: ex.message,
            },
        ];
    }

    // SDK ValidationException (400 from SDK)
    if (ex instanceof SdkResponseError && ex.statusCode === 400) {
        return [
            400,
            {
                message: ex.message,
            },
        ];
    }

    // ReferenceException (404 from SDK)
    if (ex instanceof SdkResponseError && ex.statusCode === 404) {
        return [
            404,
            {
                message: ex.message,
            },
        ];
    }

    // ApiException
    if (ex instanceof SdkResponseError) {
        return [
            422,
            {
                message: ex.message,
            },
        ];
    }

    if (ex instanceof ConfigurationError) {
        return [
            422,
            {
                message: ex.message,
            },
        ];
    }

    // App ValidationError (from validators)
    if (ex instanceof ValidationError) {
        return [
            400,
            {
                message: ex.errors[0] ?? ex.message,
            },
        ];
    }

    return [
        500,
        {
            code: 500,
            description: 'Internal Server Error.',
        },
    ];
}
