module Business
  module Domain
    module Payments
      module PaymentDetails
        class PaymentProduct3203SpecificOutput
          attr_accessor :billing_address, :shipping_address

          def initialize(billing_address: nil, shipping_address: nil)
            @billing_address = billing_address
            @shipping_address = shipping_address
          end

          def to_h
            {
              'billingAddress' => @billing_address&.to_h,
              'shippingAddress' => @shipping_address&.to_h
            }
          end
        end
      end
    end
  end
end
