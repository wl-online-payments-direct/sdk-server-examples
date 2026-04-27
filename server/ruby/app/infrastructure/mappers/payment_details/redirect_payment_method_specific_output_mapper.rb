module Infrastructure
  module Mappers
    module PaymentDetails
      class RedirectPaymentMethodSpecificOutputMapper
        def self.from_sdk_response(response)
          return nil if response.nil?

          Business::Domain::Payments::PaymentDetails::RedirectPaymentMethodSpecificOutput.new(
            token: response.token,
            authorisation_code: response.authorisation_code,
            payment_product_id: response.payment_product_id,
            payment_option: response.payment_option,
            fraud_results: Infrastructure::Mappers::PaymentDetails::CardFraudResultsMapper.from_sdk_response(response.fraud_results),
            customer_bank_account: Infrastructure::Mappers::PaymentDetails::CustomerBankAccountMapper.from_sdk_response(response.customer_bank_account),
            payment_product840_specific_output: Infrastructure::Mappers::PaymentDetails::PaymentProduct840SpecificOutputMapper.from_sdk_response(response.payment_product840_specific_output),
            payment_product3203_specific_output: Infrastructure::Mappers::PaymentDetails::PaymentProduct3203SpecificOutputMapper.from_sdk_response(response.payment_product3203_specific_output),
            payment_product5001_specific_output: Infrastructure::Mappers::PaymentDetails::PaymentProduct5001SpecificOutputMapper.from_sdk_response(response.payment_product5001_specific_output),
            payment_product5402_specific_output: Infrastructure::Mappers::PaymentDetails::PaymentProduct5402SpecificOutputMapper.from_sdk_response(response.payment_product5402_specific_output),
            payment_product5500_specific_output: Infrastructure::Mappers::PaymentDetails::PaymentProduct5500SpecificOutputMapper.from_sdk_response(response.payment_product5500_specific_output)
          )
        end
      end
    end
  end
end