from typing import Optional
from app.application.domain.payments.payment_details.payment_product_840_specific_output import PaymentProduct840SpecificOutput
from onlinepayments.sdk.domain.payment_product840_specific_output import PaymentProduct840SpecificOutput as PaymentProduct840SpecificOutputSdk
from app.infrastructure.mappers.payment_details.address_mapper import AddressMapper
from app.infrastructure.mappers.payment_details.payment_product_840_customer_account_mapper import PaymentProduct840CustomerAccountMapper
from app.infrastructure.mappers.payment_details.protection_eligibility_mapper import ProtectionEligibilityMapper

class PaymentProduct840SpecificOutputMapper:

    @staticmethod
    def map_from_sdk_response(response: Optional[PaymentProduct840SpecificOutputSdk]) -> Optional[PaymentProduct840SpecificOutput]:
        if response is None:
            return None

        dto = PaymentProduct840SpecificOutput()
        dto.billing_address = AddressMapper.map_from_sdk_response(response.billing_address)
        dto.customer_account = PaymentProduct840CustomerAccountMapper.map_from_sdk_response(response.customer_account)
        dto.customer_address = AddressMapper.map_from_sdk_response(response.customer_address)
        dto.protection_eligibility = ProtectionEligibilityMapper.map_from_sdk_response(response.protection_eligibility)

        return dto