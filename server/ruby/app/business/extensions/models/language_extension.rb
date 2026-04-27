module Business
  module Extensions
    module Models
      module LanguageExtension
        COUNTRY_TO_LANGUAGE = {
          'FR' => 'fr',
          'DE' => 'de',
          'GB' => 'en',
        }.freeze

        LANGUAGE_ISO_CODES = {
          'English' => 'en',
          'German'  => 'de',
          'French'  => 'fr'
        }.freeze


        module_function

        def from_country(country_enum)
          return nil if country_enum.nil? || country_enum.to_s.empty?

          iso_country = CountryExtension.to_iso_alpha2(country_enum)
          return nil if iso_country.nil? || iso_country.empty?

          COUNTRY_TO_LANGUAGE[iso_country.upcase]
        end

        def to_locale(language_enum, country_enum)
          return nil if language_enum.nil? || country_enum.nil?

          language_code = LANGUAGE_ISO_CODES[language_enum.to_s.downcase]
          return nil if language_code.nil? || language_code.empty?

          country_code = CountryExtension.to_iso_alpha2(country_enum)
          return nil if country_code.nil? || country_code.empty?

          "#{language_code}-#{country_code}"
        end
      end
    end
  end
end
