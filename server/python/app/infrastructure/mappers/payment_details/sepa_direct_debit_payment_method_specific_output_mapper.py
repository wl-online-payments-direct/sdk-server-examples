from typing import Optional
from app.application.domain.payments.payment_details.sepa_direct_debit_payment_method_specific_output import SepaDirectDebitPaymentMethodSpecificOutput
from onlinepayments.sdk.domain.sepa_direct_debit_payment_method_specific_output import SepaDirectDebitPaymentMethodSpecificOutput as SepaDirectDebitPaymentMethodSpecificOutputSdk
from app.infrastructure.mappers.payment_details.fraud_results_mapper import FraudResultsMapper
from app.infrastructure.mappers.payment_details.payment_product_771_specific_output_mapper import PaymentProduct771SpecificOutputMapper

class SepaDirectDebitPaymentMethodSpecificOutputMapper:

    @staticmethod
    def map_from_sdk_response(response: Optional[SepaDirectDebitPaymentMethodSpecificOutputSdk]) -> Optional[SepaDirectDebitPaymentMethodSpecificOutput]:
        if response is None:
            return None

        return SepaDirectDebitPaymentMethodSpecificOutput(
            payment_product_id = response.payment_product_id,
            fraud_results = FraudResultsMapper.map_from_sdk_response(response.fraud_results),
            payment_product_771_specific_output = PaymentProduct771SpecificOutputMapper.map_from_sdk_response(response.payment_product771_specific_output),
        )