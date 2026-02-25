package com.onlinepayments.example.api.validators.common.iban;

import com.onlinepayments.example.api.exceptions.ApiValidationException;
import com.onlinepayments.example.service.domain.common.enums.Country;

import static com.onlinepayments.example.api.validators.BaseValidator.isNullOrEmpty;

public class IbanValidator {
    public static void validateIban(String iban, Country country) {
        if (isNullOrEmpty(iban)) {
            return;
        }

        String cleanedIban = iban.replaceAll("[^A-Za-z0-9]", "").toUpperCase();

        if (!cleanedIban.matches("^[A-Z]{2}\\d{2}[A-Z0-9]+$")) {
            throw new ApiValidationException(
                    "The IBAN filed format is invalid (expected: 2 letters country + 2 digits + alphanumerics)."
            );
        }

        if (country != null) {
            String prefix;
            int expectedLength;

            switch (country) {
                case France -> {
                    prefix = "FR";
                    expectedLength = 27;
                }
                case Germany -> {
                    prefix = "DE";
                    expectedLength = 22;
                }
                case England -> {
                    prefix = "GB";
                    expectedLength = 22;
                }
                default -> throw new ApiValidationException("The IBAN country is not supported.");
            }

            if (!cleanedIban.startsWith(prefix) || cleanedIban.length() != expectedLength) {
                throw new ApiValidationException(
                        "The IBAN field must start with '" + prefix + "' and be " +
                                expectedLength + " characters for " + country.name() + "."
                );
            }
        }

        if (!hasValidIbanChecksum(cleanedIban)) {
            throw new ApiValidationException("IBAN checksum is invalid.");
        }
    }

    private static boolean hasValidIbanChecksum(String iban) {
        String rearranged = iban.substring(4) + iban.substring(0, 4);

        int remainder = 0;
        for (int i = 0; i < rearranged.length(); i++) {
            char ch = rearranged.charAt(i);
            String digits = Character.isLetter(ch)
                    ? String.valueOf((ch - 'A') + 10)
                    : String.valueOf(ch);

            for (char d : digits.toCharArray()) {
                remainder = (remainder * 10 + (d - '0')) % 97;
            }
        }

        return remainder == 1;
    }
}
