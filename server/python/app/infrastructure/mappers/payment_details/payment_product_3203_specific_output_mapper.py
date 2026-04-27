from typing import Optional
from app.application.domain.payments.payment_details.payment_product_3203_specific_output import PaymentProduct3203SpecificOutput
from app.infrastructure.mappers.payment_details.address_personal_mapper import AddressPersonalMapper
from onlinepayments.sdk.domain.payment_product3203_specific_output import PaymentProduct3203SpecificOutput as PaymentProduct3203SpecificOutputSdk

class PaymentProduct3203SpecificOutputMapper:

    @staticmethod
    def map_from_sdk_response(
        response: Optional[PaymentProduct3203SpecificOutputSdk],
    ) -> Optional[PaymentProduct3203SpecificOutput]:
        if response is None:
            return None

        dto = PaymentProduct3203SpecificOutput()
        dto.billing_address = AddressPersonalMapper.map_from_sdk_response(response.billing_address)
        dto.shipping_address = AddressPersonalMapper.map_from_sdk_response(response.shipping_address)

        return dto