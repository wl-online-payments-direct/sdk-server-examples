package com.onlinepayments.example.api.validators.additionalpaymentactionvalidator;

import com.onlinepayments.example.api.exceptions.ApiValidationException;
import com.onlinepayments.example.api.models.additionalpaymentactions.AdditionalPaymentActionRequest;
import org.springframework.stereotype.Component;

import java.math.BigDecimal;

@Component
public class AdditionalPaymentActionValidator {
    public void validate(AdditionalPaymentActionRequest request) {
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
    }
}
