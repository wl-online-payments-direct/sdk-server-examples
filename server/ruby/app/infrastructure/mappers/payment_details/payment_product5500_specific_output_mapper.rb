module Infrastructure
  module Mappers
    module PaymentDetails
      class PaymentProduct5500SpecificOutputMapper
        def self.from_sdk_response(response)
          return nil if response.nil?

          Business::Domain::Payments::PaymentDetails::PaymentProduct5500SpecificOutput.new(
            payment_reference: response.payment_reference,
            payment_end_date: response.payment_end_date,
            payment_start_date: response.payment_start_date,
            entity_id: response.entity_id
          )
        end
      end
    end
  end
end