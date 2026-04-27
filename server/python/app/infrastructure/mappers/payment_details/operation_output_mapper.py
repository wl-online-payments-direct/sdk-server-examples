from app.application.domain.payments.payment_details.operation_output import OperationOutput
from app.infrastructure.mappers.payment_details.amount_of_money_mapper import AmountOfMoneyMapper
from app.infrastructure.mappers.payment_details.operation_payment_references_mapper import OperationPaymentReferencesMapper
from app.infrastructure.mappers.payment_details.payment_references_mapper import PaymentReferencesMapper
from app.infrastructure.mappers.payment_details.payment_status_output_mapper import PaymentStatusOutputMapper

class OperationOutputMapper:

    @staticmethod
    def map_from_sdk_response(response) -> OperationOutput:
        dto = OperationOutput()
        dto.id = response.id
        dto.operation_references = OperationPaymentReferencesMapper.map_from_sdk_response(response.operation_references)
        dto.payment_method = response.payment_method
        dto.status_output = PaymentStatusOutputMapper.map_from_sdk_response(response.status_output)

        dto.amount_of_money = AmountOfMoneyMapper.map_from_sdk_response(response.amount_of_money)

        dto.references = PaymentReferencesMapper.map_from_sdk_response(response.references)

        dto.status = response.status
        return dto