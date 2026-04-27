from app.application.domain.enums.common.currency import Currency
from app.application.exceptions.validation_exception import ValidationException
from app.presentation.models.additional_payment_actions.request import AdditionalPaymentActionsRequest

class AdditionalPaymentActionsValidator:

    def validate(self, request: AdditionalPaymentActionsRequest) -> None:
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

        if errors:
            raise ValidationException(errors)