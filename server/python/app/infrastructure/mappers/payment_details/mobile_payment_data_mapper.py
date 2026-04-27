from typing import Optional
from app.application.domain.payments.payment_details.mobile_payment_data import MobilePaymentData
from onlinepayments.sdk.domain.mobile_payment_data import MobilePaymentData as MobilePaymentDataSdk

class MobilePaymentDataMapper:

    @staticmethod
    def map_from_sdk_response(response: Optional[MobilePaymentDataSdk]) -> Optional[MobilePaymentData]:
        if response is None:
            return None

        dto = MobilePaymentData()
        dto.dpan = response.dpan
        dto.expiry_date = response.expiry_date

        return dto