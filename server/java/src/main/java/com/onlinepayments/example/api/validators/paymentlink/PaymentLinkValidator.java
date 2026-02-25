package com.onlinepayments.example.api.validators.paymentlink;

import com.onlinepayments.example.api.exceptions.ApiValidationException;
import com.onlinepayments.example.api.models.paymentlinks.CreatePaymentLinkRequest;
import org.springframework.stereotype.Component;

import java.math.BigDecimal;

@Component
public class PaymentLinkValidator {
    private static final int MAX_DESCRIPTION_LENGTH = 1000;

    public void validate(CreatePaymentLinkRequest request) throws ApiValidationException {
        if (request == null) {
            throw new ApiValidationException("Request cannot be null.");
        }

        if (request.description().length() >= MAX_DESCRIPTION_LENGTH) {
            throw new ApiValidationException("The Description field must be shorter than " + MAX_DESCRIPTION_LENGTH + " characters.");
        }

        if (request.amount() == null) {
            throw new ApiValidationException("The Amount field is required.");
        }

        if (request.amount().compareTo(BigDecimal.ZERO) <= 0) {
            throw new ApiValidationException("The Amount field must be greater than zero.");
        }

        if (request.currency() == null) {
            throw new ApiValidationException("The Currency field is required.");
        }

        if (request.validFor() == null) {
            throw new ApiValidationException("The ValidFor field is required.");
        }

        if (request.action() == null) {
            throw new ApiValidationException("The Action field is required.");
        }
    }
}
