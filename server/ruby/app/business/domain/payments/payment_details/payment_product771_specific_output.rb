module Business
  module Domain
    module Payments
      module PaymentDetails
        class PaymentProduct771SpecificOutput
          attr_accessor :mandate_reference

          def initialize(mandate_reference: nil)
            @mandate_reference = mandate_reference
          end

          def to_h
            {
              'mandateReference' => @mandate_reference
            }
          end
        end
      end
    end
  end
end