from onlinepayments.sdk.domain.create_mandate_request import CreateMandateRequest
from onlinepayments.sdk.domain.mandate_customer import MandateCustomer
from onlinepayments.sdk.domain.bank_account_iban import BankAccountIban
from onlinepayments.sdk.domain.mandate_address import MandateAddress
from onlinepayments.sdk.domain.mandate_personal_information import MandatePersonalInformation
from onlinepayments.sdk.domain.mandate_personal_name import MandatePersonalName
from app.application.domain.enums.common.country import Country
from app.application.domain.payments.mandate import Mandate
from app.application.dtos.get_mandate.response_dto import GetMandateResponseDto

class MandateMapper:

    @staticmethod
    def to_sdk_request(request_dto) -> CreateMandateRequest:
        mandate = request_dto.mandate

        create_mandate = CreateMandateRequest()

        customer = MandateCustomer()

        bank_account = BankAccountIban()
        bank_account.iban = mandate.iban if mandate else None
        customer.bank_account_iban = bank_account

        address = MandateAddress()
        addr = mandate.address if mandate else None
        if addr and addr.country:
            address.country_code = Country.to_iso_alpha2(addr.country)
        address.city = addr.city if addr else None
        address.street = addr.street if addr else None
        address.zip = addr.zip if addr else None
        customer.mandate_address = address

        personal_info = MandatePersonalInformation()
        name = MandatePersonalName()
        name.first_name = addr.first_name if addr else None
        name.surname = addr.last_name if addr else None
        personal_info.name = name
        customer.personal_information = personal_info

        create_mandate.customer = customer
        create_mandate.customer_reference = mandate.customer_reference if mandate else None
        create_mandate.recurrence_type = mandate.recurrence_type.value if mandate and mandate.recurrence_type else None
        create_mandate.return_url = mandate.return_url if mandate else None
        create_mandate.signature_type = mandate.signature_type.value if mandate and mandate.signature_type else None

        return create_mandate

    @staticmethod
    def from_sdk_get_response(sdk_response) -> GetMandateResponseDto:
        mandate = getattr(sdk_response, 'mandate', None)

        return GetMandateResponseDto(
            mandate_reference=getattr(mandate, 'unique_mandate_reference', None)
        )

    @staticmethod
    def from_sdk_create_response(sdk_response) -> Mandate:
        mandate = Mandate()
        mandate.iban = sdk_response.mandate.customer.bank_account_iban.iban
        mandate.customer_reference = sdk_response.mandate.customer_reference
        mandate.return_url = sdk_response.merchant_action.redirect_data.redirect_url

        return mandate