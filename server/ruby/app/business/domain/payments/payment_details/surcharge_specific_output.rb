module Business
  module Domain
    module Payments
      module PaymentDetails
        class SurchargeSpecificOutput
          attr_accessor :mode, :surcharge_amount, :surcharge_rate

          def initialize(mode: nil, surcharge_amount: nil, surcharge_rate: nil)
            @mode = mode
            @surcharge_amount = surcharge_amount
            @surcharge_rate = surcharge_rate
          end

          def to_h
            {
              'mode' => @mode,
              'surchargeAmount' => @surcharge_amount&.to_h,
              'surchargeRate' => @surcharge_rate&.to_h
            }
          end
        end
      end
    end
  end
end