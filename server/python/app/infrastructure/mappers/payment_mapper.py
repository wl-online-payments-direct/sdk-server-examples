from app.application.dtos.create_payment.request_dto import CreatePaymentRequestDto
from app.application.dtos.create_payment.response_dto import CreatePaymentResponseDto
from app.application.domain.payments.status_output import StatusOutput
from onlinepayments.sdk.domain.create_payment_request import CreatePaymentRequest
from app.infrastructure.mappers.create_payment.credit_card_payment_mapper import CreditCardPaymentMapper
from app.infrastructure.mappers.create_payment.direct_debit_payment_mapper import DirectDebitPaymentMapper
from app.infrastructure.mappers.create_payment.order_mapper import OrderMapper
from app.infrastructure.mappers.create_payment.tokenized_payment_mapper import TokenizedPaymentMapper

class PaymentMapper:

    @staticmethod
    def to_sdk_request(request_dto: CreatePaymentRequestDto) -> CreatePaymentRequest:
        payment_request = CreatePaymentRequest()

        payment_request.order = OrderMapper.to_sdk_request(request_dto)

        method = request_dto.method.value if request_dto.method else None
        if method == "CREDIT_CARD":
            payment_request.card_payment_method_specific_input = CreditCardPaymentMapper.to_sdk_request(request_dto)
        elif method == "TOKEN":
            payment_request.hosted_tokenization_id = request_dto.hosted_tokenization_id

            payment_request.card_payment_method_specific_input = TokenizedPaymentMapper.to_sdk_request(request_dto)
        elif method == "DIRECT_DEBIT":
            payment_request.sepa_direct_debit_payment_method_specific_input = DirectDebitPaymentMapper.to_sdk_request(
                request_dto)

        return payment_request

    @staticmethod
    def from_sdk_response(response) -> CreatePaymentResponseDto:
        payment = getattr(response, 'payment', None)

        status = getattr(payment, 'status', None)
        payment_id = getattr(payment, 'id', None)

        status_output_obj = getattr(payment, 'status_output', None)
        status_output = StatusOutput(
            status_code=getattr(status_output_obj, 'status_code', None),
            status_category=getattr(status_output_obj, 'status_category', None)
        ) if status_output_obj else StatusOutput()

        return CreatePaymentResponseDto(
            id=payment_id,
            status=status,
            status_output=status_output
        )
