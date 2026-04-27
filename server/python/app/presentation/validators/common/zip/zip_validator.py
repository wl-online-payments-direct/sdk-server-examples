import re

UK_POSTCODE_REGEX = re.compile(
    r'^([Gg][Ii][Rr]\s?0[Aa]{2}|((([A-Za-z][0-9]{1,2})|(([A-Za-z][A-HJ-Ya-hj-y][0-9]{1,2})'
    r'|(([A-Za-z][0-9][A-Za-z])|([A-Za-z][A-HJ-Ya-hj-y][0-9][A-Za-z]?))))\s?[0-9][A-Za-z]{2}))$',
    re.IGNORECASE
)
FRANCE_ZIP_REGEX = re.compile(r'^(?:0[1-9]|[1-8]\d|9[0-5]|97[1-8]|98\d)\d{3}$')
GERMANY_ZIP_REGEX = re.compile(r'^(0[1-9]\d{3}|[1-9]\d{4})$')

class ZipValidator:

    @staticmethod
    def validate_zip_for_country(zip_code: str, country: str) -> str | None:
        if not zip_code or not zip_code.strip():
            return None

        z = zip_code.strip()
        c = country.strip() if country else ""

        if c in ("France", "FR", "fr"):
            if not FRANCE_ZIP_REGEX.match(z):
                return "Zip code must be 5 digits for France."

        elif c in ("Germany", "DE", "de"):
            if not GERMANY_ZIP_REGEX.match(z):
                return "Zip code must be 5 digits for Germany."

        elif c in ("England", "United Kingdom", "UK", "GB", "uk", "gb"):
            if not UK_POSTCODE_REGEX.match(z):
                return "UK postcode must be in a valid format (e.g., SW1A 2AA, W1A 0AX, M1 1AE)."

        else:
            return "Zip/postal code is invalid for the selected country."

        return None