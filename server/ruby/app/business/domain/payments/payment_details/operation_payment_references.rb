module Business
  module Domain
    module Payments
      module PaymentDetails
        class OperationPaymentReferences
          attr_accessor :merchant_reference

          def initialize(merchant_reference: nil)
            @merchant_reference = merchant_reference
          end

          def to_h
            {
              'merchantReference' => @merchant_reference
            }
          end
        end
      end
    end
  end
end