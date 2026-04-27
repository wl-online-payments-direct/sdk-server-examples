from typing import Optional
from app.application.domain.payments.payment_details.payment_product_840_customer_account import PaymentProduct840CustomerAccount
from onlinepayments.sdk.domain.payment_product840_customer_account import PaymentProduct840CustomerAccount as PaymentProduct840CustomerAccountSdk

class PaymentProduct840CustomerAccountMapper:

    @staticmethod
    def map_from_sdk_response(
        response: Optional[PaymentProduct840CustomerAccountSdk],
    ) -> Optional[PaymentProduct840CustomerAccount]:
        if response is None:
            return None

        dto = PaymentProduct840CustomerAccount()
        dto.account_id = response.account_id
        dto.company_name = response.company_name
        dto.country_code = response.country_code
        dto.first_name = response.first_name
        dto.customer_account_status = response.customer_account_status
        dto.customer_address_status = response.customer_address_status
        dto.payer_id = response.payer_id
        dto.surname = response.surname

        return dto