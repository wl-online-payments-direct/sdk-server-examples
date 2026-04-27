require_relative 'iban_contract'

module Presentation
  module Validators
    module Common
      module Iban
        class IbanValidator
          def validate(iban_or_object, country = nil)
            iban = extract_iban(iban_or_object)

            params = { iban: iban, country: country }
            result = IbanContract.new.call(params)

            if result.failure?
              message = result.errors.to_h.values.flatten.first
              raise Business::Exceptions::ValidationErrorResponse.new(message)
            end

            true
          end

          private

          def extract_iban(value)
            return value if value.is_a?(String) || value.nil?

            if value.is_a?(Hash)
              value['iban'] || value[:iban]
            elsif value.respond_to?(:iban)
              value.iban
            elsif value.respond_to?(:to_h)
              h = value.to_h
              h['iban'] || h[:iban]
            else
              nil
            end
          end
        end
      end
    end
  end
end