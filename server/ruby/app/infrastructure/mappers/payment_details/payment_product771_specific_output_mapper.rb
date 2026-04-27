module Infrastructure
  module Mappers
    module PaymentDetails
      class PaymentProduct771SpecificOutputMapper
        def self.from_sdk_response(response)
          return nil if response.nil?

          Business::Domain::Payments::PaymentDetails::PaymentProduct771SpecificOutput.new(
            mandate_reference: response.mandate_reference
          )
        end
      end
    end
  end
end