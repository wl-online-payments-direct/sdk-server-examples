module Business
  module Domain
    module Payments
      module PaymentDetails
        class MobilePaymentMethodSpecificOutput
          attr_accessor :authorisation_code, :fraud_results, :network, :payment_data,
                        :payment_product_id, :three_d_secure_results

          def initialize(authorisation_code: nil, fraud_results: nil, network: nil,
                         payment_data: nil, payment_product_id: nil, three_d_secure_results: nil)
            @authorisation_code = authorisation_code
            @fraud_results = fraud_results
            @network = network
            @payment_data = payment_data
            @payment_product_id = payment_product_id
            @three_d_secure_results = three_d_secure_results
          end

          def to_h
            {
              'authorisationCode' => @authorisation_code,
              'fraudResults' => @fraud_results&.to_h,
              'network' => @network,
              'paymentData' => @payment_data&.to_h,
              'paymentProductId' => @payment_product_id,
              'threeDSecureResults' => @three_d_secure_results&.to_h
            }
          end
        end
      end
    end
  end
end
