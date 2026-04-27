module Infrastructure
  module Mappers
    module PaymentDetails
      class CardFraudResultsMapper
        def self.from_sdk_response(response)
          return nil if response.nil?

          dto = Business::Domain::Payments::PaymentDetails::CardFraudResults.new
          dto.avs_result = response.avs_result
          dto.fraud_service_result = response.fraud_service_result
          dto.cvv_result = response.cvv_result

          dto
        end
      end
    end
  end
end
