require 'dry/validation'
require 'bigdecimal'

module Presentation
  module Validators
    module PaymentLink
      class PaymentLinkContract < Dry::Validation::Contract
        SMALLEST_UNIT = 100

        params do
          optional(:amount)
          optional(:currency)
          optional(:description)
          optional(:valid_for)
          optional(:action)
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

          key.failure('The Amount field is invalid.') unless minor_units == minor_units.round(0)
          key.failure('The Amount field must be greater than zero.') if minor_units.to_i <= 0

          values[:amount] = minor_units.to_i
        end

        rule(:currency) do
          if value.nil? || value.to_s.strip.empty?
            key.failure('The Currency field is required.')
          else
            key.failure('The Currency field is invalid.') unless
              Business::Domain::Enums::Common::Currency::ALL.include?(value.to_s)
          end
        end

        rule(:description) do
          next if value.nil?

          key.failure('The Description field must be shorter than 1000 characters.') if value.length > 1000
        end

        rule(:valid_for) do
          if value.nil? || value.to_s.strip.empty?
            key.failure('The ValidFor field is required.')
            next
          end

          str = value.to_s.strip

          unless str.match?(/\A\d+\z/)
            key.failure('The ValidFor field is invalid.')
            next
          end

          valid_values = Business::Domain::Enums::PaymentLinks::ValidFor::ALL.map{ |v| v }

          unless valid_values.include?(str.to_i)
            key.failure(
              "The ValidFor field is invalid and must be a number from the following set: #{valid_values.join(', ')}."
            )
          end
        end

        rule(:action) do
          if value.nil? || value.to_s.strip.empty?
            key.failure('The Action field is required.')
          else
            key.failure('The Action field is invalid.') unless
              Business::Domain::Enums::PaymentLinks::Action::ALL.include?(value.to_s.upcase)
          end
        end
      end
    end
  end
end