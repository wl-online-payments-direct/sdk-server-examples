package com.onlinepayments.example.api.exceptions;

public class ApiValidationException extends RuntimeException {
    public ApiValidationException(String message) {
        super(message);
    }

    public ApiValidationException(String message, Throwable cause) {
        super(message, cause);
    }
}
