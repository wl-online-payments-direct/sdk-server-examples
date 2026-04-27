require 'dry/validation'

module Presentation
  module Validators
    module AdditionalPaymentActions
      class AdditionalPaymentActionsContract < Dry::Validation::Contract
        SMALLEST_UNIT = 100

        params do
          optional(:amount)
          optional(:currency)
          optional(:is_final)
        end

        rule(:amount) do
          if value.nil? || value.to_s.strip.empty?
            key.failure('The Amount field is required.')
            next
          end

          begin
            decimal = BigDecimal(value.to_s)
          rescue ArgumentError
            key.failure('The Amount field must be a number.')
            next
          end

          minor_units = decimal * SMALLEST_UNIT

          if minor_units.to_i <= 0
            key.failure('The Amount field must be greater than zero.')
            next
          end

          key.failure('The Amount field is invalid.') unless minor_units == minor_units.round(0)

          values[:amount] = minor_units.to_i
        end

        rule(:currency) do
          if value.nil? || value.to_s.strip.empty?
            key.failure('The Currency field is required.')
          else
            key.failure('The Currency field is invalid.') unless Business::Domain::Enums::Common::Currency::ALL.include?(value.to_s)
          end
        end
      end
    end
  end
end