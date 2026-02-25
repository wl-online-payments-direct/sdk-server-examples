package com.onlinepayments.example.api.validators.common.address;

import com.onlinepayments.example.api.exceptions.ApiValidationException;
import com.onlinepayments.example.service.domain.common.Address;

import static com.onlinepayments.example.api.validators.BaseValidator.isNullOrEmpty;

public class AdressValidator {
    public static void validateAddress(Address address) {

        if (address == null) {
            throw new ApiValidationException("Address is null.");
        }

        if (isNullOrEmpty(address.firstName())) {
            throw new ApiValidationException("The " + "Mandate.Address" + ".FirstName is required.");
        }

        if (isNullOrEmpty(address.lastName())) {
            throw new ApiValidationException("The " + "Mandate.Address" + ".LastName is required.");
        }

        if (address.country() == null) {
            throw new ApiValidationException("The " + "Mandate.Address" + ".Country field is required.");
        }

        if (isNullOrEmpty(address.zip())) {
            throw new ApiValidationException("The " + "Mandate.Address" + ".Zip field is required.");
        }

        if (isNullOrEmpty(address.city())) {
            throw new ApiValidationException("The " + "Mandate.Address" + ".City is required.");
        }

        if (isNullOrEmpty(address.street())) {
            throw new ApiValidationException("The " + "Mandate.Address" + ".Street is required.");
        }
    }
}
