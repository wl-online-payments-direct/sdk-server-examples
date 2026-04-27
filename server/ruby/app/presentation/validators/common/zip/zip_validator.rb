module Presentation
  module Validators
    module Common
      module ZipValidator
        UK_POSTCODE_REGEX = %r{\A([Gg][Ii][Rr]\s?0[Aa]{2}|((([A-Za-z][0-9]{1,2})|(([A-Za-z][A-HJ-Ya-hj-y][0-9]{1,2})|(([A-Za-z][0-9][A-Za-z])|([A-Za-z][A-HJ-Ya-hj-y][0-9][A-Za-z]?))))\s?[0-9][A-Za-z]{2}))\z}i
        FRANCE_ZIP_REGEX  = /\A(?:0[1-9]|[1-8]\d|9[0-5]|97[1-8]|98\d)\d{3}\z/
        GERMANY_ZIP_REGEX = /\A(0[1-9]\d{3}|[1-9]\d{4})\z/

        module_function

        def validate_zip_for_country(zip, country)
          return nil if zip.nil? || zip.to_s.strip.empty?

          z = zip.to_s.strip

          case country&.to_s
          when Business::Domain::Enums::Common::Country::FRANCE, 'France', 'FR', 'fr'
            return 'Zip code must be 5 digits for France.' unless FRANCE_ZIP_REGEX.match?(z)
          when Business::Domain::Enums::Common::Country::GERMANY, 'Germany', 'DE', 'de'
            return 'Zip code must be 5 digits for Germany.' unless GERMANY_ZIP_REGEX.match?(z)
          when Business::Domain::Enums::Common::Country::ENGLAND, 'England', 'United Kingdom', 'UK', 'GB', 'uk', 'gb'
            return 'UK postcode must be in a valid format (e.g., SW1A 2AA, W1A 0AX, M1 1AE).' unless UK_POSTCODE_REGEX.match?(z)
          else
            return 'Zip/postal code is invalid for the selected country.'
          end

          nil
        end
      end
    end
  end
end