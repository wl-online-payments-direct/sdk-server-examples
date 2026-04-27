module Infrastructure
  module Mappers
    module PaymentDetails
      class PaymentProduct5402SpecificOutputMapper
        def self.from_sdk_response(response)
          return nil if response.nil?

          Business::Domain::Payments::PaymentDetails::PaymentProduct5402SpecificOutput.new(
            brand: response.brand
          )
        end
      end
    end
  end
end