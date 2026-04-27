module Business
  module Domain
    module Payments
      module PaymentDetails
        class ReattemptInstructions
          attr_accessor :conditions, :frozen_period, :indicator

          def initialize(conditions: nil, frozen_period: nil, indicator: nil)
            @conditions = conditions
            @frozen_period = frozen_period
            @indicator = indicator
          end

          def to_h
            {
              'conditions' => @conditions&.to_h,
              'frozenPeriod' => @frozen_period,
              'indicator' => @indicator
            }
          end
        end
      end
    end
  end
end