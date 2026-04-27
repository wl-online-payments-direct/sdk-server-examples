module Infrastructure
  module Mappers
    module PaymentDetails
      class SepaDirectDebitPaymentMethodSpecificOutputMapper
        def self.from_sdk_response(response)
          return nil if response.nil?

          Business::Domain::Payments::PaymentDetails::SepaDirectDebitPaymentMethodSpecificOutput.new(
            payment_product_id: response.payment_product_id,
            fraud_results: Infrastructure::Mappers::PaymentDetails::CardFraudResultsMapper.from_sdk_response(response.fraud_results),
            payment_product771_specific_output: Infrastructure::Mappers::PaymentDetails::PaymentProduct771SpecificOutputMapper.from_sdk_response(response.payment_product771_specific_output)
          )
        end
      end
    end
  end
end