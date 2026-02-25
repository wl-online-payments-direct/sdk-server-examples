package com.onlinepayments.example.sdk.mappers;

import com.onlinepayments.ApiException;
import com.onlinepayments.ValidationException;
import com.onlinepayments.AuthorizationException;
import com.onlinepayments.example.service.exceptions.SdkException;
import com.fasterxml.jackson.databind.JsonNode;
import com.fasterxml.jackson.databind.ObjectMapper;
import org.springframework.http.HttpStatus;

public class ExceptionMapper {

    private static final ObjectMapper objectMapper = new ObjectMapper();

    public static SdkException map(Exception exception) {
        return switch (exception) {
            case ValidationException ve -> map(ve);
            case AuthorizationException ae -> map(ae);
            case ApiException ape -> map(ape);
            default -> new SdkException(
                    "An unexpected error occurred.",
                    HttpStatus.INTERNAL_SERVER_ERROR
            );
        };
    }

    public static SdkException map(ApiException apiException, String customMessage) {
        String message = customMessage != null
                ? customMessage
                : extractMessage(apiException);

        HttpStatus statusCode = extractStatusCode(apiException);

        return new SdkException(message, statusCode);
    }

    public static SdkException map(ApiException apiException) {
        return map(apiException, null);
    }

    public static SdkException map(ValidationException validationException) {
        String message = extractValidationMessage(validationException);

        return new SdkException(message, HttpStatus.BAD_REQUEST);
    }

    public static SdkException map() {
        return new SdkException("Invalid merchant data.", HttpStatus.FORBIDDEN);
    }

    private static String extractMessage(ApiException apiException) {
        try {
            String body = apiException.getResponseBody();
            JsonNode root = objectMapper.readTree(body);
            JsonNode errors = root.path("errors");

            if (errors.isArray() && !errors.isEmpty()) {
                JsonNode firstError = errors.get(0);

                String id = firstError.path("id").asText(null);
                if (id != null && !id.isEmpty()) {
                    return id;
                }

                String message = firstError.path("message").asText(null);
                if (message != null && !message.isEmpty()) {
                    return message;
                }

                String category = firstError.path("category").asText(null);
                String errorCode = firstError.path("errorCode").asText(null);
                if (category != null || errorCode != null) {
                    return String.format("%s (%s)", category, errorCode);
                }
            }

            String id = root.path("id").asText(null);
            if (id != null && !id.isEmpty()) {
                return id;
            }

            String message = root.path("message").asText(null);
            if (message != null && !message.isEmpty()) {
                return message;
            }

            return "An error occurred while processing the payment.";
        } catch (Exception e) {
            return "Error could not be retrieved.";
        }
    }

    private static String extractValidationMessage(ValidationException validationException) {
        try {
            String body = validationException.getResponseBody();
            JsonNode root = objectMapper.readTree(body);
            JsonNode errors = root.path("errors");

            if (errors.isArray() && !errors.isEmpty()) {
                StringBuilder sb = new StringBuilder();
                for (JsonNode err : errors) {
                    if (!sb.isEmpty()) {
                        sb.append(" - ");
                    }

                    String id = err.path("id").asText(null);
                    String message = err.path("message").asText(null);

                    sb.append(id != null && !id.isEmpty() ? id : message);
                }

                return sb.toString();
            }

            return validationException.getMessage();
        } catch (Exception e) {
            return "Validation error occurred.";
        }
    }

    private static HttpStatus extractStatusCode(ApiException apiException) {
        try {
            String body = apiException.getResponseBody();
            JsonNode root = objectMapper.readTree(body);
            JsonNode errors = root.path("errors");

            if (errors.isArray() && !errors.isEmpty()) {
                JsonNode firstError = errors.get(0);
                int status = firstError.path("httpStatusCode").asInt(0);

                if (status != 0) {
                    return HttpStatus.valueOf(status);
                }
            }

            return HttpStatus.UNPROCESSABLE_ENTITY;
        } catch (Exception e) {
            return HttpStatus.UNPROCESSABLE_ENTITY;
        }
    }
}