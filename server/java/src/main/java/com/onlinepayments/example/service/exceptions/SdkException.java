package com.onlinepayments.example.service.exceptions;

import org.springframework.http.HttpStatus;

public class SdkException extends RuntimeException {
    private final HttpStatus statusCode;

    public SdkException(String message, HttpStatus statusCode) {
        super(message);
        this.statusCode = statusCode;
    }

    public HttpStatus getStatusCode() {
        return statusCode;
    }
}