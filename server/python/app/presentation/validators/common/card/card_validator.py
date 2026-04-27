import re
import calendar
from datetime import date
from app.application.domain.payments.card import Card

class CardValidator:

    def validate(self, card: Card, prefix: str = "Card") -> list[str]:
        errors = []

        if not card:
            errors.append(f"The {prefix} object is required.")
            
            return errors

        number = (card.number or "").strip()
        holder_name = (card.holder_name or "").strip()
        verification_code = (card.verification_code or "").strip()
        expiry_month = str(card.expiry_month or "").strip()
        expiry_year = str(card.expiry_year or "").strip()

        if not number:
            errors.append(f"The {prefix}.Number field is required.")
        elif not re.match(r'^\d+$', number):
            errors.append(f"The {prefix}.Number field must be a valid number.")
        elif len(number) > 19:
            errors.append(f"The {prefix}.Number field must be shorter than 20 characters.")

        if not holder_name:
            errors.append(f"The {prefix}.HolderName field is required.")

        if not verification_code:
            errors.append(f"The {prefix}.VerificationCode field is required.")
        elif not re.match(r'^\d{3,4}$', verification_code):
            errors.append(f"The {prefix}.VerificationCode field must be 3 or 4 digits long.")

        if not expiry_month:
            errors.append(f"The {prefix}.ExpiryMonth field is required.")
        elif not re.match(r'^\d+$', expiry_month):
            errors.append(f"The {prefix}.ExpiryMonth field must be a number.")
        elif len(expiry_month) != 2:
            errors.append(f"The {prefix}.ExpiryMonth field must be 2 digits long.")
        elif not (1 <= int(expiry_month) <= 12):
            errors.append(f"The {prefix}.ExpiryMonth field must be a number between 01 and 12.")

        if not expiry_year:
            errors.append(f"The {prefix}.ExpiryYear field is required.")
        elif not re.match(r'^\d+$', expiry_year):
            errors.append(f"The {prefix}.ExpiryYear field must be a number.")
        elif len(expiry_year) != 4:
            errors.append(f"The {prefix}.ExpiryYear field must be 4 digits long.")

        if not errors and expiry_month and expiry_year:
            if re.match(r'^\d+$', expiry_month) and re.match(r'^\d+$', expiry_year):
                if len(expiry_month) == 2 and len(expiry_year) == 4:
                    m = int(expiry_month)
                    y = int(expiry_year)
                    if 1 <= m <= 12:
                        try:
                            last_day = calendar.monthrange(y, m)[1]
                            expiry_date = date(y, m, last_day)
                            if expiry_date <= date.today():
                                errors.append("The card expiry date must be in the future.")
                        except ValueError:
                            errors.append("The card expiry date is invalid.")

        return errors