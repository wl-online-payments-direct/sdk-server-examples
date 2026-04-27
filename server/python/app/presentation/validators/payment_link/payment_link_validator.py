from app.application.domain.enums.common.currency import Currency
from app.application.domain.enums.payment_links.action import Action
from app.application.domain.enums.payment_links.valid_for import ValidFor
from app.application.exceptions.validation_exception import ValidationException
from app.presentation.models.payment_link.request import PaymentLinkRequest

class PaymentLinkValidator:

    def validate(self, request: PaymentLinkRequest) -> None:
        errors = []

        if request.amount is None:
            errors.append("The Amount field is required.")
        else:
            try:
                amount = float(request.amount)
                if amount <= 0:
                    errors.append("The Amount field must be greater than zero.")
            except (ValueError, TypeError):
                errors.append("The Amount field must be a number.")

        if not request.currency:
            errors.append("The Currency field is required.")
        elif not Currency.has_value(request.currency):
            errors.append("The Currency field is invalid.")

        if request.description and len(request.description) > 1000:
            errors.append("The Description field must be shorter than 1000 characters.")

        if request.valid_for is None:
            errors.append("The ValidFor field is required.")
        else:
            try:
                valid_for_int = int(request.valid_for)
                if not ValidFor.has_value(valid_for_int):
                    errors.append("The ValidFor field is in invalid range and must be a number from the following set: 24, 48, 336, 720.")
            except (ValueError, TypeError):
                errors.append("The ValidFor field is invalid.")

        if not request.action:
            errors.append("The Action field is required.")
        elif not Action.has_value(request.action):
            errors.append("The Action field is invalid.")

        if errors:
            raise ValidationException(errors)