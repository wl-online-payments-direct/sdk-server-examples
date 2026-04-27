module Business
  module Domain
    module Payments
      module PaymentDetails
        class SepaDirectDebitPaymentMethodSpecificOutput
          attr_accessor :fraud_results, :payment_product771_specific_output, :payment_product_id

          def initialize(payment_product_id: nil, fraud_results: nil, payment_product771_specific_output: nil)
            @payment_product_id = payment_product_id
            @fraud_results = fraud_results
            @payment_product771_specific_output = payment_product771_specific_output
          end

          def to_h
            {
              'paymentProductId' => @payment_product_id,
              'fraudResults' => @fraud_results&.to_h,
              'paymentProduct771SpecificOutput' => @payment_product771_specific_output&.to_h
            }
          end
        end
      end
    end
  end
end