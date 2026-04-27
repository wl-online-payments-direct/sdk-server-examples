module Business
  module Domain
    module Payments
      module PaymentDetails
        class CardPaymentMethodSpecificOutput
          attr_accessor :acquirer_information, :authorisation_code, :card, :fraud_results,
                        :payment_account_reference, :payment_product_id, :three_d_secure_results,
                        :initial_scheme_transaction_id, :scheme_reference_data, :token,
                        :payment_option, :external_token_linked, :authenticated_amount,
                        :currency_conversion, :payment_product3208_specific_output,
                        :payment_product3209_specific_output, :reattempt_instructions

          def initialize(acquirer_information: nil, authorisation_code: nil, card: nil, fraud_results: nil,
                         payment_account_reference: nil, payment_product_id: nil, three_d_secure_results: nil,
                         initial_scheme_transaction_id: nil, scheme_reference_data: nil, token: nil,
                         payment_option: nil, external_token_linked: nil, authenticated_amount: nil,
                         currency_conversion: nil, payment_product3208_specific_output: nil,
                         payment_product3209_specific_output: nil, reattempt_instructions: nil)
            @acquirer_information = acquirer_information
            @authorisation_code = authorisation_code
            @card = card
            @fraud_results = fraud_results
            @payment_account_reference = payment_account_reference
            @payment_product_id = payment_product_id
            @three_d_secure_results = three_d_secure_results
            @initial_scheme_transaction_id = initial_scheme_transaction_id
            @scheme_reference_data = scheme_reference_data
            @token = token
            @payment_option = payment_option
            @external_token_linked = external_token_linked
            @authenticated_amount = authenticated_amount
            @currency_conversion = currency_conversion
            @payment_product3208_specific_output = payment_product3208_specific_output
            @payment_product3209_specific_output = payment_product3209_specific_output
            @reattempt_instructions = reattempt_instructions
          end

          def to_h
            {
              'acquirerInformation' => @acquirer_information&.to_h,
              'authorisationCode' => @authorisation_code,
              'card' => @card&.to_h,
              'fraudResults' => @fraud_results&.to_h,
              'paymentAccountReference' => @payment_account_reference,
              'paymentProductId' => @payment_product_id,
              'threeDSecureResults' => @three_d_secure_results&.to_h,
              'initialSchemeTransactionId' => @initial_scheme_transaction_id,
              'schemeReferenceData' => @scheme_reference_data,
              'token' => @token,
              'paymentOption' => @payment_option,
              'externalTokenLinked' => @external_token_linked&.to_h,
              'authenticatedAmount' => @authenticated_amount,
              'currencyConversion' => @currency_conversion&.to_h,
              'paymentProduct3208SpecificOutput' => @payment_product3208_specific_output&.to_h,
              'paymentProduct3209SpecificOutput' => @payment_product3209_specific_output&.to_h,
              'reattemptInstructions' => @reattempt_instructions&.to_h
            }
          end
        end
      end
    end
  end
end