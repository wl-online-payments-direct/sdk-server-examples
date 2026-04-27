from onlinepayments.sdk.validation_exception import ValidationException as SdkValidationException
from onlinepayments.sdk.authorization_exception import AuthorizationException
from onlinepayments.sdk.api_exception import ApiException
from onlinepayments.sdk.declined_payment_exception import DeclinedPaymentException
from onlinepayments.sdk.reference_exception import ReferenceException
from app.application.exceptions.sdk_exception import SdkException

class ExceptionMapper:
    @staticmethod
    def map(exception: Exception, custom_message: str = None) -> SdkException:
        if isinstance(exception, SdkValidationException):
            return SdkException(ExceptionMapper._extract_message(exception), 400, exception)
        if isinstance(exception, AuthorizationException):
            return SdkException("Invalid merchant data.", 403, exception)
        if isinstance(exception, (ApiException, DeclinedPaymentException, ReferenceException)):
            return ExceptionMapper._map_sdk_error_exception(exception, custom_message)
        return SdkException("An unexpected error occurred.", 500, exception)

    @staticmethod
    def _map_sdk_error_exception(exception: Exception, custom_message: str = None) -> SdkException:
        message = custom_message or ExceptionMapper._extract_message(exception)
        status_code = ExceptionMapper._extract_status_code(exception)
        return SdkException(message, status_code, exception)

    @staticmethod
    def _extract_message(exception: Exception) -> str:
        try:
            if hasattr(exception, 'errors') and exception.errors:
                first = exception.errors[0]
                if getattr(first, 'id', None):
                    return first.id
                if getattr(first, 'message', None):
                    return first.message
                category = getattr(first, 'category', '') or ''
                error_code = getattr(first, 'error_code', '') or ''
                return f"{category} ({error_code})"
            return str(exception)
        except Exception:
            return "Error could not be retrieved."

    @staticmethod
    def _extract_status_code(exception: Exception) -> int:
        try:
            if hasattr(exception, 'status_code') and exception.status_code:
                return exception.status_code
            if hasattr(exception, 'errors') and exception.errors:
                first = exception.errors[0]
                status = getattr(first, 'http_status_code', 0) or 0
                if status > 0:
                    return status
            return 422
        except Exception:
            return 422