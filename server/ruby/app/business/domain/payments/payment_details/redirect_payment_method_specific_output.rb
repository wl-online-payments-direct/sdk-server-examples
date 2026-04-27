 module Business
  module Domain
    module Payments
      module PaymentDetails
        class RedirectPaymentMethodSpecificOutput
          attr_accessor :authorisation_code, :customer_bank_account, :fraud_results, :payment_option,
                        :payment_product3203_specific_output, :payment_product5001_specific_output,
                        :payment_product5402_specific_output, :payment_product5500_specific_output,
                        :payment_product840_specific_output, :payment_product_id, :token

          def initialize(
            authorisation_code: nil,
            customer_bank_account: nil,
            fraud_results: nil,
            payment_option: nil,
            payment_product3203_specific_output: nil,
            payment_product5001_specific_output: nil,
            payment_product5402_specific_output: nil,
            payment_product5500_specific_output: nil,
            payment_product840_specific_output: nil,
            payment_product_id: nil,
            token: nil
          )
            @authorisation_code = authorisation_code
            @customer_bank_account = customer_bank_account
            @fraud_results = fraud_results
            @payment_option = payment_option
            @payment_product3203_specific_output = payment_product3203_specific_output
            @payment_product5001_specific_output = payment_product5001_specific_output
            @payment_product5402_specific_output = payment_product5402_specific_output
            @payment_product5500_specific_output = payment_product5500_specific_output
            @payment_product840_specific_output = payment_product840_specific_output
            @payment_product_id = payment_product_id
            @token = token
          end

          def to_h
            {
              'authorisationCode' => @authorisation_code,
              'customerBankAccount' => @customer_bank_account&.to_h,
              'fraudResults' => @fraud_results&.to_h,
              'paymentOption' => @payment_option,
              'paymentProduct3203SpecificOutput' => @payment_product3203_specific_output&.to_h,
              'paymentProduct5001SpecificOutput' => @payment_product5001_specific_output&.to_h,
              'paymentProduct5402SpecificOutput' => @payment_product5402_specific_output&.to_h,
              'paymentProduct5500SpecificOutput' => @payment_product5500_specific_output&.to_h,
              'paymentProduct840SpecificOutput' => @payment_product840_specific_output&.to_h,
              'paymentProductId' => @payment_product_id,
              'token' => @token
            }
          end
        end
      end
    end
  end
end