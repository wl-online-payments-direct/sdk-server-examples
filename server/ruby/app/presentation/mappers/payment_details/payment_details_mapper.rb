module Presentation
  module Mappers
    module PaymentDetailsMapper
      module_function

      def from_dto(dto)
        mapped = Presentation::Models::GetPaymentDetails::Response.new
        mapped.id = dto.id
        mapped.status = dto.status
        mapped.status_output = dto.status_output
        mapped.operations = build_operations(dto)
        mapped.payment_output = dto.payment_output
        mapped.hosted_checkout_specific_output = dto.hosted_checkout_specific_output
        mapped
      end

      def build_operations(dto)
        return nil if dto.payment_output.nil?

        operation_output = Business::Domain::Payments::PaymentDetails::OperationOutput.new
        operation_output.id = dto.id
        operation_output.status = dto.status
        operation_output.payment_method = dto.payment_output.payment_method
        operation_output.amount_of_money = dto.payment_output.amount_of_money

        operation_output.operation_references = Business::Domain::Payments::PaymentDetails::OperationPaymentReferences.new
        operation_output.operation_references.merchant_reference =
          dto.payment_output.references&.merchant_reference

        operation_output.references = Business::Domain::Payments::PaymentDetails::PaymentReferences.new
        operation_output.references.merchant_reference =
          dto.payment_output.references&.merchant_reference
        operation_output.references.merchant_parameters =
          dto.payment_output.references&.merchant_parameters

        operation_output.status_output = dto.status_output

        [operation_output]
      end

      private :build_operations
    end
  end
end