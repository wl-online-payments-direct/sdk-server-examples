module Business
  module Domain
    module Payments
      module PaymentDetails
        class AcquirerSelectionInformation
          attr_accessor :fallback_level, :result, :rule_name

          def initialize(fallback_level: nil, result: nil, rule_name: nil)
            @fallback_level = fallback_level
            @result = result
            @rule_name = rule_name
          end

          def to_h
            {
              'fallbackLevel' => @fallback_level,
              'result' => @result,
              'ruleName' => @rule_name
            }
          end
        end
      end
    end
  end
end