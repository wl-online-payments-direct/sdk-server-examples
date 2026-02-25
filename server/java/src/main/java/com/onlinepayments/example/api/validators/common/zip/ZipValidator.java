package com.onlinepayments.example.api.validators.common.zip;

import com.onlinepayments.example.api.exceptions.ApiValidationException;
import com.onlinepayments.example.service.domain.common.Address;

import java.util.regex.Pattern;

public class ZipValidator {
    public static void validateZip(Address address) {
        if (address == null || address.zip() == null || address.zip().isBlank()) {
            return;
        }

        if (address.country() == null) {
            return;
        }

        String z = address.zip().trim();

        boolean valid;
        switch (address.country()) {
            case France -> valid = z.matches("^(?:0[1-9]|[1-8]\\d|9[0-5]|97[1-8]|98\\d)\\d{3}$");
            case Germany -> valid = z.matches("^(0[1-9]\\d{3}|[1-9]\\d{4})$");
            case England -> valid = UK_POSTCODE_RX.matcher(z).matches();
            default -> valid = false;
        }

        if (!valid) {
            String msg = switch (address.country()) {
                case France -> "Zip code must be 5 digits for France.";
                case Germany -> "Zip code must be 5 digits for Germany.";
                case England -> "UK postcode must be in a valid format (e.g., SW1A 2AA, W1A 0AX, M1 1AE).";
            };

            throw new ApiValidationException(msg);
        }
    }

    private static final Pattern UK_POSTCODE_RX = Pattern.compile(
            "^(GIR 0AA|[A-Z]{1,2}\\d[A-Z\\d]? \\d[A-Z]{2})$", Pattern.CASE_INSENSITIVE
    );
}
