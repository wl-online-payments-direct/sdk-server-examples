module Business
  module Domain
    module Enums
      module PaymentLinks
        module ValidFor
          ONE_DAY   = 24
          TWO_DAYS  = 48
          TWO_WEEKS = 336
          ONE_MONTH = 720

          ALL = [ONE_DAY, TWO_DAYS, TWO_WEEKS, ONE_MONTH].freeze

          module_function

          def from_raw(input)
            return nil if input.nil?
            ALL.find { |v| v == input.to_i }
          end

          def to_i(value)
            value
          end
        end
      end
    end
  end
end
