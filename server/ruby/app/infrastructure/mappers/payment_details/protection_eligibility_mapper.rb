module Infrastructure
  module Mappers
    module PaymentDetails
      class ProtectionEligibilityMapper
        def self.from_sdk_response(response)
          return nil if response.nil?

          Business::Domain::Payments::PaymentDetails::ProtectionEligibility.new(
            eligibility: response.eligibility,
            type: response.type
          )
        end
      end
    end
  end
end