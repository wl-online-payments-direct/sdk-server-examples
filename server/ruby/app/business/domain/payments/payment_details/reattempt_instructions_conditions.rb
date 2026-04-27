module Business
  module Domain
    module Payments
      module PaymentDetails
        class ReattemptInstructionsConditions
          attr_accessor :max_attempts, :max_delay

          def initialize(max_attempts: nil, max_delay: nil)
            @max_attempts = max_attempts
            @max_delay = max_delay
          end

          def to_h
            {
              'maxAttempts' => @max_attempts,
              'maxDelay' => @max_delay
            }
          end
        end
      end
    end
  end
end