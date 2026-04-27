require 'dry/validation'
require 'uri'
require 'bigdecimal'

module Presentation
  module Validators
    module HostedCheckout
      class HostedCheckoutContract < Dry::Validation::Contract
        SMALLEST_UNIT = 100

        params do
          optional(:amount)
          optional(:currency)
          optional(:language)
          optional(:redirect_url)

          optional(:billing_address).maybe(:hash)
          optional(:shipping_address).maybe(:hash)
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

        rule(:language) do
          if value.nil? || value.to_s.strip.empty?
            key.failure('The Language field is required.')
          else
            key.failure('The Language field is invalid.') unless Business::Domain::Enums::Common::Language::ALL.include?(value.to_s)
          end
        end

        rule(:redirect_url) do
          next if value.nil? || value.to_s.strip.empty?

          begin
            uri = URI.parse(value.to_s)
            key.failure('The RedirectUrl field is invalid.') unless uri.is_a?(URI::HTTP) || uri.is_a?(URI::HTTPS)
          rescue URI::InvalidURIError
            key.failure('The RedirectUrl field is invalid.')
          end
        end

        rule(:billing_address) do
          next if value.nil?
          next if values[:billing_address].values.all? { |v| v.to_s.strip.empty? }

          begin
            Presentation::Validators::Common::Address::AddressValidator.new.validate(value, 'BillingAddress')
          rescue Business::Exceptions::ValidationErrorResponse => e
            key.failure(e.errors.first)
          end
        end

        rule(:shipping_address) do
          next if value.nil?
          next if values[:billing_address].values.all? { |v| v.to_s.strip.empty? }

          begin
            Presentation::Validators::Common::Address::AddressValidator.new.validate(value, 'ShippingAddress')
          rescue Business::Exceptions::ValidationErrorResponse => e
            key.failure(e.errors.first)
          end
        end
      end
    end
  end
end