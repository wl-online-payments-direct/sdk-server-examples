module Infrastructure
  module Mappers
    module PaymentDetails
      class ExternalTokenLinkedMapper
        def self.from_sdk_response(response)
          return nil if response.nil?

          dto = Business::Domain::Payments::PaymentDetails::ExternalTokenLinked.new
          dto.computed_token = response.computed_token
          dto.generated_token = response.generated_token
          dto.gts_computed_token = response.gts_computed_token

          dto
        end
      end
    end
  end
end
