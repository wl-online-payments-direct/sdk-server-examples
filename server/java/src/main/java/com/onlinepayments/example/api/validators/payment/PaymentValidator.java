package com.onlinepayments.example.api.validators.payment;

import com.onlinepayments.example.api.exceptions.ApiValidationException;
import com.onlinepayments.example.api.models.payments.CreatePaymentRequest;
import com.onlinepayments.example.api.validators.BaseValidator;
import com.onlinepayments.example.api.validators.common.card.CardValidator;
import com.onlinepayments.example.api.validators.common.mandate.MandateValidator;
import com.onlinepayments.example.api.validators.common.zip.ZipValidator;
import com.onlinepayments.example.service.domain.payments.Card;
import com.onlinepayments.example.service.domain.payments.enums.PaymentMethodType;
import org.springframework.stereotype.Component;
import java.math.BigDecimal;

@Component
public class PaymentValidator extends BaseValidator {

    public void validate(CreatePaymentRequest request) {
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

        if (request.method() == null) {
            throw new ApiValidationException("The Method field is required.");
        }

        if (request.hostedTokenizationId() != null && request.card() != null) {
            if (!isCardEmpty(request.card())) {
                throw new ApiValidationException("If hosted tokenization id is provided, card details must not be filled.");
            }
        }

        if (request.method() == PaymentMethodType.CREDIT_CARD) {
            CardValidator.validateCard(request.card());
        }

        if (request.method() == PaymentMethodType.DIRECT_DEBIT) {
            MandateValidator.validateMandate(request.mandate());
            ZipValidator.validateZip(request.mandate().getAddress());
        }
    }

    private boolean isCardEmpty(Card card) {
        return card == null
                || (isNullOrEmpty(card.number())
                && isNullOrEmpty(card.holderName())
                && isNullOrEmpty(card.verificationCode())
                && isNullOrEmpty(card.expiryMonth())
                && isNullOrEmpty(card.expiryYear()));
    }
}
