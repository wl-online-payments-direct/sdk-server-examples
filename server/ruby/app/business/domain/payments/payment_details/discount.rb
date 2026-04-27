module Business
  module Domain
    module Payments
      module PaymentDetails
        class Discount
          attr_accessor :amount

          def initialize(amount: nil)
            @amount = amount
          end

          def to_h
            {
              'amount' => @amount
            }
          end
        end
      end
    end
  end
end