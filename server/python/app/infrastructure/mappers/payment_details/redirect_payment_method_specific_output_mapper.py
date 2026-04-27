from typing import Optional
from app.application.domain.payments.payment_details.redirect_payment_method_specific_output import RedirectPaymentMethodSpecificOutput
from onlinepayments.sdk.domain.redirect_payment_method_specific_output import RedirectPaymentMethodSpecificOutput as RedirectPaymentMethodSpecificOutputSdk
from app.infrastructure.mappers.payment_details.fraud_results_mapper import FraudResultsMapper
from app.infrastructure.mappers.payment_details.customer_bank_account_mapper import CustomerBankAccountMapper
from app.infrastructure.mappers.payment_details.payment_product_840_specific_output_mapper import PaymentProduct840SpecificOutputMapper
from app.infrastructure.mappers.payment_details.payment_product_3203_specific_output_mapper import PaymentProduct3203SpecificOutputMapper
from app.infrastructure.mappers.payment_details.payment_product_5001_specific_output_mapper import PaymentProduct5001SpecificOutputMapper
from app.infrastructure.mappers.payment_details.payment_product_5402_specific_output_mapper import PaymentProduct5402SpecificOutputMapper
from app.infrastructure.mappers.payment_details.payment_product_5500_specific_output_mapper import PaymentProduct5500SpecificOutputMapper

class RedirectPaymentMethodSpecificOutputMapper:

    @staticmethod
    def map_from_sdk_response(response: Optional[RedirectPaymentMethodSpecificOutputSdk]) -> Optional[RedirectPaymentMethodSpecificOutput]:
        if response is None:
            return None

        dto = RedirectPaymentMethodSpecificOutput()
        dto.token = response.token
        dto.authorisation_code = response.authorisation_code
        dto.payment_product_id = response.payment_product_id
        dto.payment_option = response.payment_option
        dto.fraud_results = FraudResultsMapper.map_from_sdk_response(response.fraud_results)
        dto.customer_bank_account = CustomerBankAccountMapper.map_from_sdk_response(response.customer_bank_account)
        dto.payment_product_840_specific_output = PaymentProduct840SpecificOutputMapper.map_from_sdk_response(response.payment_product840_specific_output)
        dto.payment_product_3203_specific_output = PaymentProduct3203SpecificOutputMapper.map_from_sdk_response(response.payment_product3203_specific_output)
        dto.payment_product_5001_specific_output = PaymentProduct5001SpecificOutputMapper.map_from_sdk_response(response.payment_product5001_specific_output)
        dto.payment_product_5402_specific_output = PaymentProduct5402SpecificOutputMapper.map_from_sdk_response(response.payment_product5402_specific_output)
        dto.payment_product_5500_specific_output = PaymentProduct5500SpecificOutputMapper.map_from_sdk_response(response.payment_product5500_specific_output)

        return dto