require 'dry/validation'

module Presentation
  module Validators
    module Common
      module Iban
        class IbanContract < Dry::Validation::Contract
          BASIC_IBAN_REGEX = /\A[A-Z]{2}\d{2}[A-Z0-9]+\z/.freeze

          IBAN_LENGTHS = {
            'FR' => 27,
            'DE' => 22,
            'GB' => 22
          }.freeze

          params do
            required(:iban)
            optional(:country)
          end

          rule(:iban) do
            next if value.nil? || value.to_s.strip.empty?

            unless value.to_s =~ /\A[a-zA-Z0-9\s]+\z/
              key.failure('IBAN format is invalid (expected: 2 letters country + 2 digits + alphanumerics).')
              next
            end

            normalized = value.to_s.gsub(/\s/, '').upcase

            unless normalized.match?(BASIC_IBAN_REGEX)
              key.failure('IBAN format is invalid (expected: 2 letters country + 2 digits + alphanumerics).')
              next
            end

            unless has_valid_checksum?(normalized)
              key.failure('IBAN checksum is invalid.')
            end
          end

          rule(:iban, :country) do
            next if values[:iban].nil? || values[:iban].to_s.strip.empty?
            next if values[:country].nil?

            normalized = values[:iban].to_s.gsub(/\s/, '').upcase
            next unless normalized.match?(BASIC_IBAN_REGEX)

            spec = get_country_spec(values[:country])
            if spec.nil?
              key(:iban).failure('IBAN country is not supported.')
            else
              prefix = spec[:prefix]
              expected_length = spec[:length]
              unless normalized.start_with?(prefix) && normalized.length == expected_length
                country_name = values[:country].respond_to?(:value) ? values[:country].value : prefix
                key(:iban).failure("IBAN must start with '#{prefix}' and be #{expected_length} characters for #{country_name}.")
              end
            end
          end

          private

          def get_country_spec(country)
            iso = Business::Extensions::Models::CountryExtension.to_iso_alpha2(country)

            return nil if iso.nil? || iso.to_s.strip.empty?
            return nil unless IBAN_LENGTHS.key?(iso)

            { prefix: iso, length: IBAN_LENGTHS[iso] }
          end

          def has_valid_checksum?(iban)
            rear = iban[4..-1] + iban[0, 4]

            numeric = ''.dup
            rear.each_char do |ch|
              if ch =~ /[A-Z]/
                numeric << (ch.ord - 'A'.ord + 10).to_s
              elsif ch =~ /\d/
                numeric << ch
              else
                return false
              end
            end

            remainder = 0
            numeric.scan(/.{1,7}/).each do |part|
              number_to_check = "#{remainder}#{part}"
              remainder = number_to_check.to_i % 97
            end

            remainder == 1
          rescue StandardError
            false
          end
        end
      end
    end
  end
end