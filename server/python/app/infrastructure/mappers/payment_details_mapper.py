from typing import Optional
from onlinepayments.sdk.domain.payment_details_response import PaymentDetailsResponse
from app.application.dtos.get_payment_details.response_dto import GetPaymentDetailsResponseDto
from app.infrastructure.mappers.payment_details.payment_status_output_mapper import PaymentStatusOutputMapper
from app.infrastructure.mappers.payment_details.payment_output_mapper import PaymentOutputMapper
from app.infrastructure.mappers.payment_details.hosted_checkout_specific_output_mapper import HostedCheckoutSpecificOutputMapper
from app.infrastructure.mappers.payment_details.operation_output_mapper import OperationOutputMapper

class PaymentDetailsMapper:

    @staticmethod
    def from_sdk_response(response: Optional[PaymentDetailsResponse]) -> GetPaymentDetailsResponseDto:
        dto = GetPaymentDetailsResponseDto()
        dto.id = getattr(response, 'id', None)
        dto.status = getattr(response, 'status', None)
        dto.status_output = PaymentStatusOutputMapper.map_from_sdk_response(
            getattr(response, 'status_output', None)
        )
        dto.payment_output = PaymentOutputMapper.map_from_sdk_response(
            getattr(response, 'payment_output', None)
        )
        dto.hosted_checkout_specific_output = HostedCheckoutSpecificOutputMapper.map_from_sdk_response(
            getattr(response, 'hosted_checkout_specific_output', None)
        )
        operations = getattr(response, 'operations', None)
        dto.operations = [
            OperationOutputMapper.map_from_sdk_response(op) for op in operations
        ] if operations else None
        return dto