require 'dry/validation'
require 'uri'

module Presentation
  module Validators
    module Common
      module Mandate
        class MandateContract < Dry::Validation::Contract
          params do
            optional(:customer_reference)
            optional(:mandate_reference)
            optional(:iban)
            optional(:recurrence_type)
            optional(:signature_type)
            optional(:return_url)
            optional(:address).maybe(:hash)
          end

          rule(:customer_reference) do
            if value.to_s.strip.empty?
              key.failure('The CustomerReference field is required.')
              next
            end

            if value.to_s.length > 35
              key.failure('The CustomerReference field must be shorter than 36 characters.')
            end
          end

          rule(:mandate_reference, :iban) do
            mandate_ref = values[:mandate_reference].to_s.strip
            iban_val = values[:iban].to_s.strip

            if mandate_ref.empty? && iban_val.empty?
              key(:iban).failure('IBAN is required when mandate reference is not provided.')
            end
          end

          rule(:recurrence_type) do
            if value.nil? || value.to_s.strip.empty?
              key.failure('The RecurrenceType field is required.')
              next
            end

            unless Business::Domain::Enums::Payments::RecurrenceType.try_from(value)
              key.failure('The RecurrenceType field is invalid.')
            end
          end

          rule(:signature_type) do
            if value.nil? || value.to_s.strip.empty?
              key.failure('The SignatureType field is required.')
              next
            end

            unless Business::Domain::Enums::Payments::SignatureType.try_from(value)
              key.failure('The SignatureType field is invalid.')
            end
          end

          rule(:return_url) do
            val = value.to_s.strip
            next if val.empty?

            valid =
              begin
                val =~ /\Ahttps?:\/\//i &&
                  (uri = URI.parse(val)) &&
                  (uri.is_a?(URI::HTTP) || uri.is_a?(URI::HTTPS)) &&
                  uri.host.present?
              rescue URI::InvalidURIError
                false
              end

            key.failure('The RedirectUrl field is invalid') unless valid
          end


          rule(:mandate_reference, :address) do
            mandate_ref = values[:mandate_reference].to_s.strip

            if mandate_ref.empty?
              if values[:address].nil?
                key(:address).failure('Address is required when mandate reference is not provided.')
              else
                begin
                  Presentation::Validators::Common::Address::AddressValidator.new.validate(values[:address], 'Mandate.Address')
                rescue Business::Exceptions::ValidationErrorResponse => e
                  key(:address).failure(e.errors.first)
                end
              end
            end
          end

          rule(:iban, :address) do
            next if values[:iban].to_s.strip.empty?

            if values[:iban].to_s.length > 50
              key(:iban).failure('The IBAN field must be shorter than 51 characters.')
              next
            end

            country = values[:address]&.dig(:country) || values[:address]&.dig('country')

            begin
              Presentation::Validators::Common::Iban::IbanValidator.new.validate(values[:iban].to_s, country)
            rescue Business::Exceptions::ValidationErrorResponse => e
              key(:iban).failure(e.errors.first)
            end
          end
        end
      end
    end
  end
end
