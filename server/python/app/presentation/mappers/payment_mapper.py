from app.application.domain.enums.common.currency import Currency
from app.application.domain.enums.payments.payment_method_type import PaymentMethodType
from app.application.domain.payments.status_output import StatusOutput
from app.application.dtos.create_payment.request_dto import CreatePaymentRequestDto
from app.application.dtos.create_payment.response_dto import CreatePaymentResponseDto
from app.presentation.models.create_payment.request import CreatePaymentRequest
from app.presentation.models.create_payment.response import CreatePaymentResponse

SMALLEST_UNIT = 100

class PaymentPresentationMapper:

    @staticmethod
    def to_dto(request: CreatePaymentRequest) -> CreatePaymentRequestDto:
        return CreatePaymentRequestDto(
            amount=int(float(request.amount) * SMALLEST_UNIT),
            currency=Currency(request.currency) if request.currency else None,
            method=PaymentMethodType(request.method) if request.method else None,
            hosted_tokenization_id=request.hosted_tokenization_id,
            billing_address=request.billing_address,
            shipping_address=request.shipping_address,
            card=request.card,
            mandate=request.mandate
        )

    @staticmethod
    def from_dto(response_dto: CreatePaymentResponseDto) -> CreatePaymentResponse:
        status_output = None
        if response_dto.status_output:
            status_output = StatusOutput(
                status_code=response_dto.status_output.status_code,
                status_category=response_dto.status_output.status_category
            )
        return CreatePaymentResponse(
            id=response_dto.id,
            status=response_dto.status,
            status_output=status_output
        )