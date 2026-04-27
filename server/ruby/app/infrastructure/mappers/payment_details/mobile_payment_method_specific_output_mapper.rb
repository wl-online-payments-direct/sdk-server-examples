module Infrastructure
  module Mappers
    module PaymentDetails
      class MobilePaymentMethodSpecificOutputMapper
        def self.from_sdk_response(response)
          return nil if response.nil?

          dto = Business::Domain::Payments::PaymentDetails::MobilePaymentMethodSpecificOutput.new
          dto.network = response.network
          dto.authorisation_code = response.authorisation_code
          dto.payment_product_id = response.payment_product_id
          dto.fraud_results = Infrastructure::Mappers::PaymentDetails::CardFraudResultsMapper.from_sdk_response(response.fraud_results)
          dto.payment_data = Infrastructure::Mappers::PaymentDetails::MobilePaymentDataMapper.from_sdk_response(response.payment_data)
          dto.three_d_secure_results = Infrastructure::Mappers::PaymentDetails::ThreeDSecureResultsMapper.from_sdk_response(response.three_d_secure_results)

          dto
        end
      end
    end
  end
end