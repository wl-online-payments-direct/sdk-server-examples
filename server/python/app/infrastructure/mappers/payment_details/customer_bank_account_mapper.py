from typing import Optional
from app.application.domain.payments.payment_details.customer_bank_account import CustomerBankAccount
from onlinepayments.sdk.domain.customer_bank_account import CustomerBankAccount as CustomerBankAccountSdk

class CustomerBankAccountMapper:

    @staticmethod
    def map_from_sdk_response(response: Optional[CustomerBankAccountSdk]) -> Optional[CustomerBankAccount]:
        if response is None:
            return None

        return CustomerBankAccount(
            account_holder_name = response.account_holder_name,
            bic = response.bic,
            iban = response.iban
        )