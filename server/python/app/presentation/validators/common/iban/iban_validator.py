import re
from app.application.domain.enums.common.country import Country

BASIC_IBAN_REGEX = re.compile(r'^[A-Z]{2}\d{2}[A-Z0-9]+$')
IBAN_LENGTHS = {"FR": 27, "DE": 22, "GB": 22}

class IbanValidator:

    def validate(self, iban: str, country: str = None) -> list[str]:
        errors = []
        if not iban or not iban.strip():
            return errors

        if not re.match(r'^[a-zA-Z0-9\s]+$', iban):
            errors.append("IBAN format is invalid (expected: 2 letters country + 2 digits + alphanumerics).")

            return errors

        normalized = iban.replace(" ", "").upper()

        if not BASIC_IBAN_REGEX.match(normalized):
            errors.append("IBAN format is invalid (expected: 2 letters country + 2 digits + alphanumerics).")

            return errors

        if not self._has_valid_checksum(normalized):
            errors.append("IBAN checksum is invalid.")

            return errors

        if country:
            iso = Country.to_iso_alpha2(country)
            if iso not in IBAN_LENGTHS:
                errors.append("IBAN country is not supported.")
            else:
                expected_length = IBAN_LENGTHS[iso]
                if not normalized.startswith(iso) or len(normalized) != expected_length:
                    errors.append(f"IBAN must start with '{iso}' and be {expected_length} characters for {country}.")

        return errors

    def _has_valid_checksum(self, iban: str) -> bool:
        try:
            rear = iban[4:] + iban[:4]
            numeric = ""
            for ch in rear:
                if ch.isalpha():
                    numeric += str(ord(ch) - ord('A') + 10)
                elif ch.isdigit():
                    numeric += ch
                else:
                    return False
            remainder = 0
            for i in range(0, len(numeric), 7):
                part = str(remainder) + numeric[i:i+7]
                remainder = int(part) % 97

            return remainder == 1
        except Exception:
            return False