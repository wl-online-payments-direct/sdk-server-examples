module Presentation
  module Validators
    module Common
      module Address
        class AddressContract < Dry::Validation::Contract
          attr_reader :prefix

          def initialize(prefix:)
            @prefix = prefix
            super()
          end

          params do
            optional(:first_name)
            optional(:last_name)
            optional(:country)
            optional(:zip)
            optional(:city)
            optional(:street)
          end

          rule(:first_name) do
            val = value.to_s.strip
            key.failure("The #{prefix}.FirstName field is required.") if val.empty?
          end

          rule(:last_name) do
            val = value.to_s.strip
            key.failure("The #{prefix}.LastName field is required.") if val.empty?
          end

          rule(:country) do
            val = value.to_s.strip
            if val.empty?
              key.failure("The #{prefix}.Country field is required.")
            else
              valid_countries = Business::Domain::Enums::Common::Country::ALL
              key.failure("The #{prefix}.Country field is invalid.") unless valid_countries.include?(val)
            end
          end

          rule(:zip) do
            zip_val = value.to_s.strip
            country_val = values[:country]

            if zip_val.empty?
              key.failure("The #{prefix}.Zip field is required.")
              next
            end

            error_message = Presentation::Validators::Common::ZipValidator.validate_zip_for_country(zip_val, country_val)
            key.failure("#{error_message}") if error_message
          end

          rule(:city) do
            val = value.to_s.strip
            key.failure("The #{prefix}.City field is required.") if val.empty?
          end

          rule(:street) do
            val = value.to_s.strip
            key.failure("The #{prefix}.Street field is required.") if val.empty?
          end
        end
      end
    end
  end
end