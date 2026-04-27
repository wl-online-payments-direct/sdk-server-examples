from app.application.domain.enums.common.country import Country
from app.application.dtos.common.address_dto import AddressDto
from app.presentation.validators.common.zip.zip_validator import ZipValidator

class AddressValidator:

    @staticmethod
    def validate(address: AddressDto, field_prefix: str) -> list[str]:
        errors = []

        first_name = (address.first_name or "").strip()
        last_name = (address.last_name or "").strip()
        country = (address.country or "").strip()
        zip_code = (address.zip or "").strip()
        city = (address.city or "").strip()
        street = (address.street or "").strip()

        if not first_name:
            errors.append(f"The {field_prefix}.FirstName field is required.")

        if not last_name:
            errors.append(f"The {field_prefix}.LastName field is required.")

        if not country:
            errors.append(f"The {field_prefix}.Country field is required.")
        elif not Country.has_value(country):
            errors.append(f"The {field_prefix}.Country field is invalid.")

        if not zip_code:
            errors.append(f"The {field_prefix}.Zip field is required.")
        else:
            zip_error = ZipValidator.validate_zip_for_country(zip_code, country)
            if zip_error:
                errors.append(zip_error)

        if not city:
            errors.append(f"The {field_prefix}.City field is required.")

        if not street:
            errors.append(f"The {field_prefix}.Street field is required.")

        return errors