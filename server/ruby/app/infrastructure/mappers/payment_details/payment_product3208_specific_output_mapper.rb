module Infrastructure
  module Mappers
    module PaymentDetails
      class PaymentProduct3208SpecificOutputMapper
        def self.from_sdk_response(response)
          return nil if response.nil?

          dto = Business::Domain::Payments::PaymentDetails::PaymentProduct3208SpecificOutput.new
          dto.buyer_compliant_bank_message = response.buyer_compliant_bank_message

          dto
        end
      end
    end
  end
end
