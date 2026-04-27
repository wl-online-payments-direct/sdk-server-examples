module Business
  module Domain
    module Enums
      module PaymentLinks
        module Status
          ACTIVE   = 'ACTIVE'.freeze
          INACTIVE = 'INACTIVE'.freeze
          EXPIRED  = 'EXPIRED'.freeze

          ALL = [ACTIVE, INACTIVE, EXPIRED].freeze

          module_function

          def from_raw(input)
            return nil if input.nil?
            value = input.to_s.upcase
            ALL.find { |v| v == value }
          end
        end
      end
    end
  end
end
