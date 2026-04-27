module Infrastructure
  module Mappers
    module PaymentDetailsMapper
      module_function

      def from_sdk_response(response)
        response_dto = Business::Dtos::GetPaymentDetails::ResponseDto.new

        response_dto.status_output = Infrastructure::Mappers::PaymentDetails::PaymentStatusOutputMapper.from_sdk_response(response&.status_output)
        response_dto.payment_output = Infrastructure::Mappers::PaymentDetails::PaymentOutputMapper.from_sdk_response(response&.payment_output)
        response_dto.status = response&.status
        response_dto.hosted_checkout_specific_output = Infrastructure::Mappers::PaymentDetails::HostedCheckoutSpecificOutputMapper.from_sdk_response(response&.hosted_checkout_specific_output)
        response_dto.id = response&.id
        response_dto.operations = map_operations(response&.operations)

        response_dto
      end

      def map_operations(operations)
        return nil if operations.nil?

        operations.map { |op| Infrastructure::Mappers::PaymentDetails::OperationOutputMapper.from_sdk_response(op) }
      end

      private :map_operations
    end
  end
end