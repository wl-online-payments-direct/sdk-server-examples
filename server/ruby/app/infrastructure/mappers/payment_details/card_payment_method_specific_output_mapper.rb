module Infrastructure
  module Mappers
    module PaymentDetails
      class CardPaymentMethodSpecificOutputMapper
        def self.from_sdk_response(response)
          return nil if response.nil?

          dto = Business::Domain::Payments::PaymentDetails::CardPaymentMethodSpecificOutput.new
          dto.card = Infrastructure::Mappers::PaymentDetails::CardEssentialsMapper.from_sdk_response(response.card)
          dto.acquirer_information = Infrastructure::Mappers::PaymentDetails::AcquirerInformationMapper.from_sdk_response(response.acquirer_information)
          dto.authorisation_code = response.authorisation_code
          dto.currency_conversion = Infrastructure::Mappers::PaymentDetails::CurrencyConversionMapper.from_sdk_response(response.currency_conversion)
          dto.authenticated_amount = response.authenticated_amount
          dto.fraud_results = Infrastructure::Mappers::PaymentDetails::CardFraudResultsMapper.from_sdk_response(response.fraud_results)
          dto.payment_option = response.payment_option
          dto.reattempt_instructions = Infrastructure::Mappers::PaymentDetails::ReattemptInstructionsMapper.from_sdk_response(response.reattempt_instructions)
          dto.external_token_linked = Infrastructure::Mappers::PaymentDetails::ExternalTokenLinkedMapper.from_sdk_response(response.external_token_linked)
          dto.payment_account_reference = response.payment_account_reference
          dto.payment_product_id = response.payment_product_id
          dto.initial_scheme_transaction_id = response.initial_scheme_transaction_id
          dto.scheme_reference_data = response.scheme_reference_data
          dto.payment_product3208_specific_output = Infrastructure::Mappers::PaymentDetails::PaymentProduct3208SpecificOutputMapper.from_sdk_response(response.payment_product3208_specific_output)
          dto.payment_product3209_specific_output = Infrastructure::Mappers::PaymentDetails::PaymentProduct3209SpecificOutputMapper.from_sdk_response(response.payment_product3209_specific_output)
          dto.three_d_secure_results = Infrastructure::Mappers::PaymentDetails::ThreeDSecureResultsMapper.from_sdk_response(response.three_d_secure_results)
          dto.token = response.token

          dto
        end
      end
    end
  end
end