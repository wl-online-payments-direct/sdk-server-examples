module Infrastructure
  module Mappers
    module PaymentDetails
      class OperationOutputMapper
        def self.from_sdk_response(response)
          return nil if response.nil?

          dto = Business::Domain::Payments::PaymentDetails::OperationOutput.new
          dto.id = response.id
          dto.operation_references = Infrastructure::Mappers::PaymentDetails::OperationPaymentReferencesMapper.from_sdk_response(response.operation_references)
          dto.payment_method = response.payment_method
          dto.status_output = Infrastructure::Mappers::PaymentDetails::PaymentStatusOutputMapper.from_sdk_response(response.status_output)
          dto.amount_of_money = Infrastructure::Mappers::PaymentDetails::AmountOfMoneyMapper.from_sdk_response(response.amount_of_money)
          dto.references = Infrastructure::Mappers::PaymentDetails::PaymentReferencesMapper.from_sdk_response(response.references)
          dto.status = response.status

          dto
        end
      end
    end
  end
end
