module Business
  module Domain
    module Payments
      module PaymentDetails
        class FraudResults
          attr_accessor :fraud_service_result

          def initialize(fraud_service_result: nil)
            @fraud_service_result = fraud_service_result
          end

          def to_h
            {
              'fraudServiceResult' => @fraud_service_result
            }
          end
        end
      end
    end
  end
end