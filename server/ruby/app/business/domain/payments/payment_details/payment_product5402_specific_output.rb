module Business
  module Domain
    module Payments
      module PaymentDetails
        class PaymentProduct5402SpecificOutput
          attr_accessor :brand

          def initialize(brand: nil)
            @brand = brand
          end

          def to_h
            {
              'brand' => @brand
            }
          end
        end
      end
    end
  end
end