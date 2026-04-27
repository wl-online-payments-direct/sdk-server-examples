from app.application.domain.enums.common.currency import Currency
from app.application.domain.enums.payments.payment_method_type import PaymentMethodType
from app.application.exceptions.validation_exception import ValidationException
from app.presentation.models.create_payment.request import CreatePaymentRequest
from app.presentation.validators.common.address.address_validator import AddressValidator
from app.presentation.validators.common.card.card_validator import CardValidator
from app.presentation.validators.common.mandate.mandate_validator import MandateValidator

class PaymentValidator:

    def validate(self, request: CreatePaymentRequest) -> None:
        errors = []

        if request.amount is None:
            errors.append("The Amount field is required.")
        else:
            try:
                amount = float(request.amount)
                if amount <= 0:
                    errors.append("The Amount field must be greater than zero.")
                elif round(amount * 100) != amount * 100:
                    errors.append("The Amount field is invalid.")
            except (ValueError, TypeError):
                errors.append("The Amount field must be a number.")

        if not request.currency:
            errors.append("The Currency field is required.")
        elif not Currency.has_value(request.currency):
            errors.append("The Currency field is invalid.")

        if not request.method:
            errors.append("The Method field is required.")
        elif not PaymentMethodType.has_value(request.method):
            errors.append("The Method field is invalid.")
        else:
            if request.method == PaymentMethodType.TOKEN.value:
                if not request.hosted_tokenization_id:
                    errors.append("The HostedTokenizationId field is required when payment method is TOKEN.")

            if request.hosted_tokenization_id and request.card:
                card = request.card
                card_empty = (
                    not (card.number or "").strip() and
                    not (card.holder_name or "").strip() and
                    not (card.verification_code or "").strip() and
                    not str(card.expiry_month or "").strip() and
                    not str(card.expiry_year or "").strip()
                )
                if not card_empty:
                    errors.append("If hosted tokenization id is provided, card details must not be filled.")

            if request.method == PaymentMethodType.CREDIT_CARD.value:
                errors.extend(CardValidator().validate(request.card))

            if request.method == PaymentMethodType.DIRECT_DEBIT.value:
                if request.mandate is None:
                    errors.append("The mandate object is required.")
                else:
                    errors.extend(MandateValidator().validate(request.mandate))

        if request.billing_address and any(vars(request.billing_address).values()):
            errors.extend(AddressValidator.validate(request.billing_address, "BillingAddress"))

        if request.shipping_address and any(vars(request.shipping_address).values()):
            errors.extend(AddressValidator.validate(request.shipping_address, "ShippingAddress"))

        if errors:
            raise ValidationException(errors)