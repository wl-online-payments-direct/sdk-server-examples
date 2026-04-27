module Infrastructure
  module Mappers
    module PaymentDetails
      class PaymentReferencesMapper
        def self.from_sdk_response(response)
          return nil if response.nil?

          Business::Domain::Payments::PaymentDetails::PaymentReferences.new.tap do |dto|
            dto.merchant_parameters = response.merchant_parameters
            dto.merchant_reference = response.merchant_reference
          end
        end
      end
    end
  end
end