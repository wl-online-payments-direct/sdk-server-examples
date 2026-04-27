import logging
from fastapi import FastAPI, Request
from fastapi.exceptions import RequestValidationError
from fastapi.responses import JSONResponse
from pydantic import ValidationError
from app.application.exceptions.sdk_exception import SdkException
from app.application.exceptions.validation_exception import ValidationException

logger = logging.getLogger(__name__)

def register_exception_handlers(app: FastAPI) -> None:
    @app.exception_handler(RequestValidationError)
    @app.exception_handler(ValidationError)
    async def request_validation_handler(request: Request, ex: RequestValidationError):
        errors = ex.errors()
        logger.error(f"Validation errors: {errors}")  # add this temporarily
        if errors:
            error = errors[0]
            error_type = error.get("type", "")
            field = error["loc"][-1] if error.get("loc") else "Field"

            field_name = "".join(word.capitalize() for word in str(field).split("_"))

            if error_type == "value_error":
                message = error.get("msg", "").replace("Value error, ", "")
            elif error_type in ("missing", "float_type"):
                message = f"The {field_name} field is required."
            else:
                message = f"The {field_name} field is invalid."
        else:
            message = "Validation error."

        return JSONResponse(
            status_code=400,
            content={"message": message},
            media_type="application/problem+json"
        )

    @app.exception_handler(SdkException)
    async def sdk_exception_handler(request: Request, ex: SdkException):
        logger.error(f"SDK exception: {str(ex)}")
        return JSONResponse(
            status_code=ex.status_code,
            content={"message": str(ex)},
            media_type="application/problem+json"
        )

    @app.exception_handler(ValidationException)
    async def validation_exception_handler(request: Request, ex: ValidationException):
        logger.error(f"Validation exception: {str(ex)}")
        return JSONResponse(
            status_code=400,
            content={"message": ex.errors[0] if ex.errors else str(ex)},
            media_type="application/problem+json"
        )

    @app.exception_handler(Exception)
    async def generic_exception_handler(request: Request, ex: Exception):
        logger.error(f"Unexpected exception: {str(ex)}")
        return JSONResponse(
            status_code=500,
            content={"code": 500, "description": "Internal Server Error."},
            media_type="application/problem+json"
        )