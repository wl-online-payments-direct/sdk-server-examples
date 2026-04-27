module Business
  module Domain
    module Enums
      module Payments
        module SignatureType
          SMS        = :SMS
          UNSIGNED   = :UNSIGNED
          TICK_BOX   = :TICK_BOX

          ALL = [SMS, UNSIGNED, TICK_BOX].freeze

          module_function

          def try_from(value)
            return nil if value.nil?
            value = value.to_sym if value.is_a?(String)
            ALL.find { |v| v == value }
          end
        end
      end
    end
  end
end
