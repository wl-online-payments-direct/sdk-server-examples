module Business
  module Extensions
    module Models
      module CountryExtension
        COUNTRY_ISO_CODES = {
          'England' => 'GB',
          'Germany' => 'DE',
          'France'  => 'FR'
        }.freeze

        def self.to_iso_alpha2(country_enum)
          return '' if country_enum.nil?

          COUNTRY_ISO_CODES[country_enum.to_s] || ''
        end
      end
    end
  end
end
