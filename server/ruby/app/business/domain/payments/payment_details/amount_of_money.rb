module Business
  module Domain
    module Payments
      module PaymentDetails
        class AmountOfMoney
          attr_accessor :amount, :currency_code

          def initialize(amount: nil, currency_code: nil)
            @amount = amount
            @currency_code = currency_code
          end

          def to_h
            {
              'amount' => @amount,
              'currencyCode' => @currency_code
            }
          end
        end
      end
    end
  end
end