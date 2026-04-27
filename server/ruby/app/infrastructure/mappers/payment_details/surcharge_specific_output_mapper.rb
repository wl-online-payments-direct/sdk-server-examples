module Infrastructure
  module Mappers
    module PaymentDetails
      class SurchargeSpecificOutputMapper
        def self.from_sdk_response(response)
          return nil if response.nil?

          Business::Domain::Payments::PaymentDetails::SurchargeSpecificOutput.new(
            mode: response.mode,
            surcharge_amount: Infrastructure::Mappers::PaymentDetails::AmountOfMoneyMapper.from_sdk_response(response.surcharge_amount),
            surcharge_rate: Infrastructure::Mappers::PaymentDetails::SurchargeRateMapper.from_sdk_response(response.surcharge_rate)
          )
        end
      end
    end
  end
end
