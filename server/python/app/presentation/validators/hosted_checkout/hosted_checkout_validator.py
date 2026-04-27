from app.application.domain.enums.common.currency import Currency
from app.application.domain.enums.common.language import Language
from app.application.exceptions.validation_exception import ValidationException
from app.presentation.models.hosted_checkout.request import HostedCheckoutRequest
from app.presentation.validators.common.address.address_validator import AddressValidator
from urllib.parse import urlparse

class HostedCheckoutValidator:

    def validate(self, request: HostedCheckoutRequest) -> None:
        errors = []

        if request.amount is None:
            errors.append("The Amount field is required.")
        elif request.amount <= 0:
            errors.append("The Amount field must be greater than zero.")

        if not request.currency:
            errors.append("The Currency field is required.")
        elif not Currency.has_value(request.currency):
            errors.append("The Currency field is invalid.")

        if not request.language:
            errors.append("The Language field is required.")
        elif not Language.has_value(request.language):
            errors.append("The Language field is invalid.")

        if request.redirect_url:
            try:
                parsed = urlparse(request.redirect_url)
                if parsed.scheme not in ("http", "https") or not parsed.netloc:
                    errors.append("The RedirectUrl field is invalid.")
                _ = parsed.port
            except ValueError:
                errors.append("The RedirectUrl field is invalid.")
            except Exception:
                errors.append("The RedirectUrl field is invalid.")

        if request.billing_address and any(vars(request.billing_address).values()):
            errors.extend(AddressValidator.validate(request.billing_address, "BillingAddress"))

        if request.shipping_address and any(vars(request.shipping_address).values()):
            errors.extend(AddressValidator.validate(request.shipping_address, "ShippingAddress"))

        if errors:
            raise ValidationException(errors)