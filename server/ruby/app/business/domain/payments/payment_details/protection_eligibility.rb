module Business
  module Domain
    module Payments
      module PaymentDetails
        class ProtectionEligibility
          attr_accessor :eligibility, :type

          def initialize(eligibility: nil, type: nil)
            @eligibility = eligibility
            @type = type
          end

          def to_h
            {
              'eligibility' => @eligibility,
              'type' => @type
            }
          end
        end
      end
    end
  end
end