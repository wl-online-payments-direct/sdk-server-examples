from typing import Optional
from app.application.domain.payments.payment_details.card_payment_method_specific_output import CardPaymentMethodSpecificOutput
from onlinepayments.sdk.domain.card_payment_method_specific_output import CardPaymentMethodSpecificOutput as CardPaymentMethodSpecificOutputSdk
from app.infrastructure.mappers.payment_details.card_essentials_mapper import CardEssentialsMapper
from app.infrastructure.mappers.payment_details.acquirer_information_mapper import AcquirerInformationMapper
from app.infrastructure.mappers.payment_details.currency_conversion_mapper import CurrencyConversionMapper
from app.infrastructure.mappers.payment_details.card_fraud_results_mapper import CardFraudResultsMapper
from app.infrastructure.mappers.payment_details.reattempt_instructions_mapper import ReattemptInstructionsMapper
from app.infrastructure.mappers.payment_details.external_token_linked_mapper import ExternalTokenLinkedMapper
from app.infrastructure.mappers.payment_details.payment_product_3208_specific_output_mapper import PaymentProduct3208SpecificOutputMapper
from app.infrastructure.mappers.payment_details.payment_product_3209_specific_output_mapper import PaymentProduct3209SpecificOutputMapper
from app.infrastructure.mappers.payment_details.three_d_secure_results_mapper import ThreeDSecureResultsMapper

class CardPaymentMethodSpecificOutputMapper:

    @staticmethod
    def map_from_sdk_response(
        response: Optional[CardPaymentMethodSpecificOutputSdk]
    ) -> Optional[CardPaymentMethodSpecificOutput]:
        if response is None:
            return None

        return CardPaymentMethodSpecificOutput(
            card=CardEssentialsMapper.map_from_sdk_response(response.card),
            acquirer_information = AcquirerInformationMapper.map_from_sdk_response(response.acquirer_information),
            authorisation_code = response.authorisation_code,
            currency_conversion = CurrencyConversionMapper.map_from_sdk_response(response.currency_conversion),
            authenticated_amount = response.authenticated_amount,
            fraud_results = CardFraudResultsMapper.map_from_sdk_response(response.fraud_results),
            payment_option = response.payment_option,
            reattempt_instructions = ReattemptInstructionsMapper.map_from_sdk_response(response.reattempt_instructions),
            external_token_linked = ExternalTokenLinkedMapper.map_from_sdk_response(response.external_token_linked),
            payment_account_reference = response.payment_account_reference,
            payment_product_id = response.payment_product_id,
            initial_scheme_transaction_id = response.initial_scheme_transaction_id,
            scheme_reference_data = response.scheme_reference_data,
            payment_product_3208_specific_output = PaymentProduct3208SpecificOutputMapper.map_from_sdk_response(response.payment_product3208_specific_output),
            payment_product_3209_specific_output = PaymentProduct3209SpecificOutputMapper.map_from_sdk_response(response.payment_product3209_specific_output),
            three_d_secure_results = ThreeDSecureResultsMapper.map_from_sdk_response(response.three_d_secure_results),
            token = response.token,
        )