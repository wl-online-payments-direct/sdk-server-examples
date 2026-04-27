module Business
  module Domain
    module Enums
      module Common
        module Currency
          EUR = 'EUR'.freeze
          USD = 'USD'.freeze

          ALL = [EUR, USD].freeze

          module_function

          def try_from(value)
            value = value.to_s.upcase
            ALL.find { |c| c == value }
          end
        end
      end
    end
  end
end
