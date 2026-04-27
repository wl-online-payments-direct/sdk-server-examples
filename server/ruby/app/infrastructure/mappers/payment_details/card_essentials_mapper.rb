module Infrastructure
  module Mappers
    module PaymentDetails
      class CardEssentialsMapper
        def self.from_sdk_response(response)
          return nil if response.nil?

          dto = Business::Domain::Payments::PaymentDetails::CardEssentials.new
          dto.country_code = response.country_code
          dto.card_number = response.card_number
          dto.expiry_date = response.expiry_date
          dto.bin = response.bin

          dto
        end
      end
    end
  end
end