module Infrastructure
  module Mappers
    module PaymentDetails
      class HostedCheckoutSpecificOutputMapper
        def self.from_sdk_response(response)
          return nil if response.nil?

          output = Business::Domain::Payments::PaymentDetails::HostedCheckoutSpecificOutput.new
          output.hosted_checkout_id = response.hosted_checkout_id
          output.variant = response.variant

          output
        end
      end
    end
  end
end
