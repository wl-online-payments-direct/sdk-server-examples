from typing import Optional
from app.application.domain.payments.payment_details.mobile_payment_method_specific_output import MobilePaymentMethodSpecificOutput
from app.infrastructure.mappers.payment_details.card_fraud_results_mapper import CardFraudResultsMapper
from app.infrastructure.mappers.payment_details.mobile_payment_data_mapper import MobilePaymentDataMapper
from app.infrastructure.mappers.payment_details.three_d_secure_results_mapper import ThreeDSecureResultsMapper
from onlinepayments.sdk.domain.mobile_payment_method_specific_output import MobilePaymentMethodSpecificOutput as MobilePaymentMethodSpecificOutputSdk

class MobilePaymentMethodSpecificOutputMapper:

    @staticmethod
    def map_from_sdk_response(response: Optional[MobilePaymentMethodSpecificOutputSdk]) -> Optional[MobilePaymentMethodSpecificOutput]:
        if response is None:
            return None

        dto = MobilePaymentMethodSpecificOutput()
        dto.network = response.network
        dto.authorisation_code = response.authorisation_code
        dto.payment_product_id = response.payment_product_id
        dto.fraud_results = CardFraudResultsMapper.map_from_sdk_response(response.fraud_results)
        dto.payment_data = MobilePaymentDataMapper.map_from_sdk_response(response.payment_data)
        dto.three_d_secure_results = ThreeDSecureResultsMapper.map_from_sdk_response(response.three_d_secure_results)

        return dto