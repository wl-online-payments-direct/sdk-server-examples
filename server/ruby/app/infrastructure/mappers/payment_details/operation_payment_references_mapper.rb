module Infrastructure
  module Mappers
    module PaymentDetails
      class OperationPaymentReferencesMapper
        def self.from_sdk_response(response)
          return nil if response.nil?

          dto = Business::Domain::Payments::PaymentDetails::OperationPaymentReferences.new
          dto.merchant_reference = response.merchant_reference

          dto
        end
      end
    end
  end
end