module Business
  module Domain
    module Payments
      module PaymentDetails
        class CustomerOutput
          attr_accessor :device

          def initialize(device: nil)
            @device = device
          end

          def to_h
            {
              'device' => @device&.to_h
            }
          end
        end
      end
    end
  end
end