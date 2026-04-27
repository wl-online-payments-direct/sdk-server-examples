module Infrastructure
  module Mappers
    module PaymentDetails
      class ReattemptInstructionsMapper
        def self.from_sdk_response(response)
          return nil if response.nil?

          Business::Domain::Payments::PaymentDetails::ReattemptInstructions.new(
            conditions: Infrastructure::Mappers::PaymentDetails::ReattemptInstructionsConditionsMapper.from_sdk_response(response.conditions),
            frozen_period: response.frozen_period,
            indicator: response.indicator
          )
        end
      end
    end
  end
end