package com.onlinepayments.example.api.validators.common.card;

import com.onlinepayments.example.api.exceptions.ApiValidationException;
import com.onlinepayments.example.service.domain.payments.Card;

import java.time.YearMonth;

import static com.onlinepayments.example.api.validators.BaseValidator.isNullOrEmpty;

public class CardValidator {
    public static void validateCard(Card card) {
        if (card == null) {
            throw new ApiValidationException("The Card object is required.");
        }

        if (isNullOrEmpty(card.number())) {
            throw new ApiValidationException("The Card.Number field is required.");
        }

        if (!card.number().chars().allMatch(Character::isDigit)) {
            throw new ApiValidationException("The Card.Number field must contain only digits.");
        }

        if (card.number().length() > 19) {
            throw new ApiValidationException(" The Card.Number field must be shorter than 20 characters.");
        }

        if (isNullOrEmpty(card.holderName())) {
            throw new ApiValidationException("The Card.HolderName field is required.");
        }

        if (isNullOrEmpty(card.verificationCode())) {
            throw new ApiValidationException("The Card.VerificationCode field is required.");
        }

        if (card.verificationCode().length() < 3 || card.verificationCode().length() > 4 || !card.verificationCode().chars().allMatch(Character::isDigit)) {
            throw new ApiValidationException("The Card.VerificationCode must be 3 or 4 digits long.");
        }

        if (!card.verificationCode().chars().allMatch(Character::isDigit)) {
            throw new ApiValidationException("The Card.VerificationCode for CREDIT_CARD payments must contain only digits.");
        }

        if (isNullOrEmpty(card.expiryMonth())) {
            throw new ApiValidationException("The Card.ExpiryMonth field is required.");
        }

        if (isNullOrEmpty(card.expiryYear())) {
            throw new ApiValidationException("The Card.ExpiryYear field is required.");
        }

        validateCardExpiryDate(card.expiryMonth(), card.expiryYear());
    }

    private static void validateCardExpiryDate(String expiryMonth, String expiryYear) {
        if (expiryMonth == null || expiryMonth.isBlank()) {
            throw new ApiValidationException("The Card.ExpiryMonth is required.");
        }

        if (expiryMonth.length() != 2) {
            throw new ApiValidationException("The Card.ExpiryMonth field must be 2 digits long.");
        }

        int month;
        try {
            month = Integer.parseInt(expiryMonth);
        } catch (NumberFormatException e) {
            throw new ApiValidationException("The Card.ExpiryMonth field must be a number.");
        }

        if (month < 1 || month > 12) {
            throw new ApiValidationException("The Card.ExpiryMonth must be a number between 01 and 12.");
        }

        if (expiryYear == null || expiryYear.isBlank()) {
            throw new ApiValidationException("The Card.ExpiryYear is required.");
        }

        if (expiryYear.length() != 4) {
            throw new ApiValidationException("The Card.ExpiryYear field must be 4 digits long.");
        }

        int year;
        try {
            year = Integer.parseInt(expiryYear);
        } catch (NumberFormatException e) {
            throw new ApiValidationException("The Card.ExpiryYear field must be a number.");
        }

        YearMonth expiry = YearMonth.of(year, month);
        if (!expiry.isAfter(YearMonth.now())) {
            throw new ApiValidationException("The card expiry date must be in the future.");
        }
    }
}
