package com.onlinepayments.example.api.validators.common.mandate;

import com.onlinepayments.example.api.exceptions.ApiValidationException;
import com.onlinepayments.example.api.validators.common.address.AdressValidator;
import com.onlinepayments.example.api.validators.common.iban.IbanValidator;
import com.onlinepayments.example.service.domain.common.enums.Country;
import com.onlinepayments.example.service.domain.payments.Mandate;

import static com.onlinepayments.example.api.validators.BaseValidator.isNullOrEmpty;
import static com.onlinepayments.example.api.validators.BaseValidator.isValidUrl;

public class MandateValidator {
    public static void validateMandate(Mandate mandate) {
        if (mandate == null) {
            throw new ApiValidationException("Mandate is required for DIRECT_DEBIT payments.");
        }

        if (isNullOrEmpty(mandate.getCustomerReference())) {
            throw new ApiValidationException("The CustomerReference field is required.");
        }

        if (mandate.getRecurrenceType() == null) {
            throw new ApiValidationException("The RecurrenceType field is required.");
        }

        if (mandate.getSignatureType() == null) {
            throw new ApiValidationException("The SignatureType field is required.");
        }

        if (mandate.getCustomerReference().length() > 35) {
            throw new ApiValidationException("The CustomerReference field must be shorter than 36 characters.");
        }

        if (isNullOrEmpty(mandate.getMandateReference()) && isNullOrEmpty(mandate.getIban())) {
            throw new ApiValidationException(
                    "The IBAN field is required when mandate reference is not provided."
            );
        }

        if (!isNullOrEmpty(mandate.getIban())) {

            if (mandate.getIban().length() > 50) {
                throw new ApiValidationException(
                        "The IBAN field must be less than 51 characters."
                );
            }

            Country country = null;
            if (mandate.getAddress() != null) {
                country = mandate.getAddress().country();
            }

            IbanValidator.validateIban(mandate.getIban(), country);
        }

        if (!isNullOrEmpty(mandate.getReturnUrl()) && !isValidUrl(mandate.getReturnUrl())) {
            throw new ApiValidationException("The ReturnUrl field is invalid.");
        }

        if (isNullOrEmpty(mandate.getMandateReference())) {
            AdressValidator.validateAddress(mandate.getAddress());
        }

        if (isNullOrEmpty(mandate.getMandateReference()) && mandate.getAddress() == null) {
            throw new ApiValidationException("Address is required when mandate reference is not provided.");
        }
    }
}
