from urllib.parse import urlparse
from app.application.domain.payments.mandate import Mandate
from app.application.domain.enums.payments.recurrence_type import RecurrenceType
from app.application.domain.enums.payments.signature_type import SignatureType
from app.presentation.validators.common.address.address_validator import AddressValidator
from app.presentation.validators.common.iban.iban_validator import IbanValidator

class MandateValidator:

    def validate(self, mandate: Mandate, prefix: str = "Mandate") -> list[str]:
        errors = []

        if not mandate:
            errors.append(f"The {prefix} field is required.")
            return errors

        customer_reference = (mandate.customer_reference or "").strip()
        mandate_reference = (mandate.mandate_reference or "").strip()
        iban = (mandate.iban or "").strip()
        recurrence_type = mandate.recurrence_type
        signature_type = mandate.signature_type
        return_url = (mandate.return_url or "").strip()
        address = mandate.address

        if not customer_reference:
            errors.append("The CustomerReference field is required.")
        elif len(customer_reference) > 35:
            errors.append("The CustomerReference field must be shorter than 36 characters.")

        if not mandate_reference and not iban:
            errors.append("IBAN is required when mandate reference is not provided.")

        if not recurrence_type:
            errors.append("The RecurrenceType field is required.")
        elif not RecurrenceType.has_value(recurrence_type.value if hasattr(recurrence_type, 'value') else recurrence_type):
            errors.append("The RecurrenceType field is invalid.")

        if not signature_type:
            errors.append("The SignatureType field is required.")
        elif not SignatureType.has_value(signature_type.value if hasattr(signature_type, 'value') else signature_type):
            errors.append("The SignatureType field is invalid.")

        if return_url:
            try:
                parsed = urlparse(return_url)
                if parsed.scheme not in ("http", "https") or not parsed.netloc:
                    errors.append("The ReturnUrl field is invalid.")
                _ = parsed.port
            except ValueError:
                errors.append("The ReturnUrl field is invalid.")
            except Exception:
                errors.append("The ReturnUrl field is invalid.")

        if not mandate_reference:
            if not address:
                errors.append("Address is required when mandate reference is not provided.")
            else:
                errors.extend(AddressValidator.validate(address, "Mandate.Address"))

        if iban and not mandate_reference:
            if len(iban) > 50:
                errors.append("The IBAN field must be shorter than 51 characters.")
            else:
                country = address.country if address else None
                iban_errors = IbanValidator().validate(iban, country)
                errors.extend(iban_errors)

        return errors