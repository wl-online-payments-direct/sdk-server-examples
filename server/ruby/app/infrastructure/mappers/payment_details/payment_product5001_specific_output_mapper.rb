module Infrastructure
  module Mappers
    module PaymentDetails
      class PaymentProduct5001SpecificOutputMapper
        def self.from_sdk_response(response)
          return nil if response.nil?

          Business::Domain::Payments::PaymentDetails::PaymentProduct5001SpecificOutput.new(
            liability: response.liability,
            account_number: response.account_number,
            authorisation_code: response.authorisation_code,
            operation_code: response.operation_code,
            mobile_phone_number: response.mobile_phone_number
          )
        end
      end
    end
  end
end