from typing import Optional
from app.application.domain.payments.payment_details.payment_output import PaymentOutput
from app.infrastructure.mappers.payment_details.amount_of_money_mapper import AmountOfMoneyMapper
from app.infrastructure.mappers.payment_details.customer_output_mapper import CustomerOutputMapper
from app.infrastructure.mappers.payment_details.discount_mapper import DiscountMapper
from app.infrastructure.mappers.payment_details.payment_references_mapper import PaymentReferencesMapper
from app.infrastructure.mappers.payment_details.surcharge_specific_output_mapper import SurchargeSpecificOutputMapper
from app.infrastructure.mappers.payment_details.card_payment_method_specific_output_mapper import CardPaymentMethodSpecificOutputMapper
from app.infrastructure.mappers.payment_details.mobile_payment_method_specific_output_mapper import MobilePaymentMethodSpecificOutputMapper
from app.infrastructure.mappers.payment_details.redirect_payment_method_specific_output_mapper import RedirectPaymentMethodSpecificOutputMapper
from app.infrastructure.mappers.payment_details.sepa_direct_debit_payment_method_specific_output_mapper import SepaDirectDebitPaymentMethodSpecificOutputMapper
from onlinepayments.sdk.domain.payment_output import PaymentOutput as PaymentOutputSdk

class PaymentOutputMapper:

    @staticmethod
    def map_from_sdk_response(response: Optional[PaymentOutputSdk]) -> Optional[PaymentOutput]:
        if response is None:
            return None

        dto = PaymentOutput()
        dto.discount = DiscountMapper.map_from_sdk_response(response.discount)
        dto.amount_of_money = AmountOfMoneyMapper.map_from_sdk_response(response.amount_of_money)
        dto.customer = CustomerOutputMapper.map_from_sdk_response(response.customer)
        dto.payment_method = response.payment_method
        dto.merchant_parameters = response.merchant_parameters
        dto.acquired_amount = AmountOfMoneyMapper.map_from_sdk_response(response.acquired_amount)
        dto.references = PaymentReferencesMapper.map_from_sdk_response(response.references)
        dto.surcharge_specific_output = SurchargeSpecificOutputMapper.map_from_sdk_response(
            response.surcharge_specific_output)
        dto.card_payment_method_specific_output = CardPaymentMethodSpecificOutputMapper.map_from_sdk_response(
            response.card_payment_method_specific_output)
        dto.mobile_payment_method_specific_output = MobilePaymentMethodSpecificOutputMapper.map_from_sdk_response(
            response.mobile_payment_method_specific_output)
        dto.redirect_payment_method_specific_output = RedirectPaymentMethodSpecificOutputMapper.map_from_sdk_response(
            response.redirect_payment_method_specific_output)
        dto.sepa_direct_debit_payment_method_specific_output = SepaDirectDebitPaymentMethodSpecificOutputMapper.map_from_sdk_response(
            response.sepa_direct_debit_payment_method_specific_output)

        return dto