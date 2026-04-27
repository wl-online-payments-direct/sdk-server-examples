module Business
  module Domain
    module Enums
      module Common
        module Status
          ACTIVE   = :ACTIVE
          INACTIVE = :INACTIVE
          EXPIRED  = :EXPIRED

          ALL = [ACTIVE, INACTIVE, EXPIRED].freeze

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
