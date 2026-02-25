package com.onlinepayments.example.api.exceptions;

import com.fasterxml.jackson.databind.JsonMappingException;
import com.fasterxml.jackson.databind.exc.InvalidFormatException;
import com.onlinepayments.example.service.exceptions.SdkException;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.http.converter.HttpMessageNotReadableException;
import org.springframework.web.HttpRequestMethodNotSupportedException;
import org.springframework.web.bind.MethodArgumentNotValidException;
import org.springframework.web.bind.annotation.ExceptionHandler;
import org.springframework.web.bind.annotation.RestControllerAdvice;
import org.springframework.web.servlet.resource.NoResourceFoundException;

import java.util.Arrays;
import java.util.Objects;
import java.util.stream.Collectors;

@RestControllerAdvice
public class GlobalExceptionHandler {

    @ExceptionHandler(SdkException.class)
    public ResponseEntity<Object> handleSdkException(SdkException ex) {
        return ResponseEntity.status(ex.getStatusCode())
                .body(new SimpleError(ex.getMessage()));
    }

    @ExceptionHandler(NoResourceFoundException.class)
    public ResponseEntity<Object> handleNotFoundException() {
        return ResponseEntity.status(HttpStatus.NOT_FOUND)
                .body(new DetailedError(404, "Not Found"));
    }

    @ExceptionHandler(HttpRequestMethodNotSupportedException.class)
    public ResponseEntity<Object> handleMethodNotSupportedException() {
        return ResponseEntity.status(HttpStatus.METHOD_NOT_ALLOWED)
                .body(new DetailedError(405, "Method not allowed"));
    }

    @ExceptionHandler(ApiValidationException.class)
    public ResponseEntity<Object> handleApiValidationException(ApiValidationException ex) {
        return ResponseEntity.status(HttpStatus.BAD_REQUEST)
                .body(new SimpleError(ex.getMessage()));
    }

    @ExceptionHandler(MethodArgumentNotValidException.class)
    public ResponseEntity<Object> handleBadRequest(Exception ex) {
        String message;

        if (ex instanceof MethodArgumentNotValidException maven) {
            message = maven.getBindingResult()
                    .getAllErrors()
                    .getFirst()
                    .getDefaultMessage();
        } else {
            message = "Invalid request payload.";
        }

        return ResponseEntity.status(HttpStatus.BAD_REQUEST)
                .body(new SimpleError(message));
    }

    @ExceptionHandler(HttpMessageNotReadableException.class)
    public ResponseEntity<Object> handleNotReadable(HttpMessageNotReadableException ex) {
        String message = extractCleanMessage(ex);

        return ResponseEntity
                .status(HttpStatus.BAD_REQUEST)
                .body(new SimpleError(message));
    }

    @ExceptionHandler(Exception.class)
    public ResponseEntity<Object> handleInternal() {
        return ResponseEntity.status(HttpStatus.INTERNAL_SERVER_ERROR)
                .body(new DetailedError(500, "Unhandled exception occurred."));
    }

    public record SimpleError(String message) {
    }

    public record DetailedError(int code, String description) {
    }

    private String extractCleanMessage(HttpMessageNotReadableException ex) {
        Throwable cause = ex.getMostSpecificCause();

        if (cause instanceof InvalidFormatException ife) {
            String fieldName = ife.getPath().stream()
                    .map(JsonMappingException.Reference::getFieldName)
                    .filter(Objects::nonNull)
                    .collect(Collectors.joining("."));

            if (fieldName.isEmpty()) {
                fieldName = "unknown";
            }

            String prettyField = Arrays.stream(fieldName.split("\\."))
                    .map(s -> s.isEmpty() ? s : Character.toUpperCase(s.charAt(0)) + s.substring(1))
                    .collect(Collectors.joining("."));

            return "The " + prettyField + " field is invalid.";
        }

        if (cause instanceof IllegalArgumentException iae) {
            String message = iae.getMessage();

            return message != null ? message : "Invalid request payload.";
        }

        return "Invalid request payload.";
    }
}