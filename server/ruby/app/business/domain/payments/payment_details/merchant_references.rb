module Business
  module Domain
    module Payments
      module PaymentDetails
        class MerchantReferences
          attr_accessor :reference

          def initialize(reference: nil)
            @reference = reference
          end

          def to_h
            {
              'reference' => @reference
            }
          end
        end
      end
    end
  end
end