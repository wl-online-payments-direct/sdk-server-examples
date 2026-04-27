from onlinepayments.sdk.domain.sepa_direct_debit_payment_method_specific_input import \
    SepaDirectDebitPaymentMethodSpecificInput
from onlinepayments.sdk.domain.sepa_direct_debit_payment_product771_specific_input import \
    SepaDirectDebitPaymentProduct771SpecificInput
from app.application.dtos.create_payment.request_dto import CreatePaymentRequestDto

DIRECT_DEBIT_PRODUCT_ID = 771

class DirectDebitPaymentMapper:
    @staticmethod
    def to_sdk_request(dto: CreatePaymentRequestDto):
        if dto is None:
            return None

        sepa_direct_debit_payment_method_specific_input = SepaDirectDebitPaymentMethodSpecificInput()
        sepa_direct_debit_payment_method_specific_input.payment_product_id = DIRECT_DEBIT_PRODUCT_ID
        sepa_direct_debit_payment_product_711_specific_input = SepaDirectDebitPaymentProduct771SpecificInput()

        if dto.mandate:
            sepa_direct_debit_payment_product_711_specific_input.existing_unique_mandate_reference = dto.mandate.mandate_reference

        sepa_direct_debit_payment_method_specific_input.payment_product771_specific_input = sepa_direct_debit_payment_product_711_specific_input

        return sepa_direct_debit_payment_method_specific_input