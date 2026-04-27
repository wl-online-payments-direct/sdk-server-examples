module Business
  module Domain
    module Payments
      module PaymentDetails
        class MobilePaymentData
          attr_accessor :dpan, :expiry_date

          def initialize(dpan: nil, expiry_date: nil)
            @dpan = dpan
            @expiry_date = expiry_date
          end

          def to_h
            {
              'dpan' => @dpan,
              'expiryDate' => @expiry_date
            }
          end
        end
      end
    end
  end
end