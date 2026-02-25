package com.onlinepayments.example.api.validators.hostedcheckout;

import com.onlinepayments.example.api.exceptions.ApiValidationException;
import com.onlinepayments.example.api.models.hostedcheckout.CreateHostedCheckoutRequest;
import com.onlinepayments.example.api.validators.BaseValidator;
import org.springframework.stereotype.Component;

import java.math.BigDecimal;

@Component

public class HostedCheckoutValidator extends BaseValidator {
    public void validate(CreateHostedCheckoutRequest request) throws ApiValidationException {
        if (request == null) {
            throw new ApiValidationException("Request cannot be null.");
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

        if (request.language() == null) {
            throw new ApiValidationException("The Language field is required.");
        }

        if (request.redirectUrl() == null) {
            throw new ApiValidationException("The RedirectUrl field is required.");
        }

        if (!isValidUrl(request.redirectUrl())) {
            throw new ApiValidationException("The RedirectUrl field is invalid.");
        }
    }
}
