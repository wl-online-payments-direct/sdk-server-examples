module Business
  module Domain
    module Payments
      module PaymentDetails
        class CardFraudResults
          attr_accessor :fraud_service_result, :avs_result, :cvv_result

          def initialize(fraud_service_result: nil, avs_result: nil, cvv_result: nil)
            @fraud_service_result = fraud_service_result
            @avs_result = avs_result
            @cvv_result = cvv_result
          end

          def to_h
            {
              'fraudServiceResult' => @fraud_service_result,
              'avsResult' => @avs_result,
              'cvvResult' => @cvv_result
            }
          end
        end
      end
    end
  end
end