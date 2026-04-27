module Business
  module Domain
    module Payments
      module PaymentDetails
        class HostedCheckoutSpecificOutput
          attr_accessor :hosted_checkout_id, :variant

          def initialize(hosted_checkout_id: nil, variant: nil)
            @hosted_checkout_id = hosted_checkout_id
            @variant = variant
          end

          def to_h
            {
              'hostedCheckoutId' => @hosted_checkout_id,
              'variant' => @variant
            }
          end
        end
      end
    end
  end
end