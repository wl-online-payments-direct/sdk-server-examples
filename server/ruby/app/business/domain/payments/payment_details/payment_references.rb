module Business
  module Domain
    module Payments
      module PaymentDetails
        class PaymentReferences
          attr_accessor :merchant_reference, :merchant_parameters

          def initialize(merchant_reference: nil, merchant_parameters: nil)
            @merchant_reference = merchant_reference
            @merchant_parameters = merchant_parameters
          end

          def to_h
            {
              'merchantReference' => @merchant_reference,
              'merchantParameters' => @merchant_parameters
            }
          end
        end
      end
    end
  end
end