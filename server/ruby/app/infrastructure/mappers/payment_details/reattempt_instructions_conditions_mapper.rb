module Infrastructure
  module Mappers
    module PaymentDetails
      class ReattemptInstructionsConditionsMapper
        def self.from_sdk_response(response)
          return nil if response.nil?

          Business::Domain::Payments::PaymentDetails::ReattemptInstructionsConditions.new(
            max_attempts: response.max_attempts,
            max_delay: response.max_delay
          )
        end
      end
    end
  end
end