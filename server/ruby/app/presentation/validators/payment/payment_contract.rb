require 'dry/validation'

module Presentation
  module Validators
    module Payment
      class PaymentContract < Dry::Validation::Contract
        SMALLEST_UNIT = 100

        params do
          optional(:amount)
          optional(:currency)
          optional(:method)
          optional(:hosted_tokenization_id)

          optional(:billing_address).maybe(:hash)
          optional(:shipping_address).maybe(:hash)
          optional(:card).maybe(:hash)
          optional(:mandate).maybe(:hash)
        end

        rule(:hosted_tokenization_id, :card) do
          if values[:hosted_tokenization_id] && values[:card]
            card = values[:card]
            card_empty = card[:number].to_s.strip.empty? &&
                         card[:holder_name].to_s.strip.empty? &&
                         card[:verification_code].to_s.strip.empty? &&
                         card[:expiry_month].to_s.strip.empty? &&
                         card[:expiry_year].to_s.strip.empty?

            unless card_empty
              key(:card).failure('If hosted tokenization id is provided, card details must not be filled.')
            end
          end
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

        rule(:method) do
          if value.nil? || value.to_s.strip.empty?
            key.failure('The Method field is required.')
            next
          end

          unless Business::Domain::Enums::Payments::PaymentMethodType.try_from(value)
            key.failure('The Method field is invalid.')
          end
        end

        rule(:hosted_tokenization_id, :method) do
          method = values[:method].to_s.strip.upcase
          tokenization_id = values[:hosted_tokenization_id].to_s.strip

          if method == 'TOKEN' && tokenization_id.empty?
            key(:hosted_tokenization_id).failure('The HostedTokenizationId field is required when payment method is TOKEN.')
          end
        end


        rule(:card, :method) do
          next unless values[:method] == 'CREDIT_CARD'

          begin
            Presentation::Validators::Common::Card::CardValidator.new.validate(values[:card])
          rescue Business::Exceptions::ValidationErrorResponse => e
            key(:card).failure(e.errors.first)
          end
        end

        rule(:mandate, :method) do
          next unless values[:method] == 'DIRECT_DEBIT'

          begin
            Presentation::Validators::Common::Mandate::MandateValidator.new.validate(values[:mandate])
          rescue Business::Exceptions::ValidationErrorResponse => e
            key(:mandate).failure(e.errors.first)
          end
        end

        rule(:billing_address) do
          next if values[:billing_address].nil?
          next if values[:billing_address].values.all? { |v| v.to_s.strip.empty? }

          begin
            Presentation::Validators::Common::Address::AddressValidator.new.validate(values[:billing_address], 'BillingAddress')
          rescue Business::Exceptions::ValidationErrorResponse => e
            key(:billing_address).failure(e.errors.first)
          end
        end

        rule(:shipping_address) do
          next if values[:shipping_address].nil?
          next if values[:billing_address].values.all? { |v| v.to_s.strip.empty? }

          begin
            Presentation::Validators::Common::Address::AddressValidator.new.validate(values[:shipping_address], 'ShippingAddress')
          rescue Business::Exceptions::ValidationErrorResponse => e
            key(:shipping_address).failure(e.errors.first)
          end
        end
      end
    end
  end
end