module Infrastructure
  module Domain
    module Payments
      module PaymentDetails
        class FraudResults
          attr_accessor :fraud_service_result

          def to_h
            {
              fraudServiceResult: fraud_service_result
            }
          end
        end
      end
    end
  end
end
