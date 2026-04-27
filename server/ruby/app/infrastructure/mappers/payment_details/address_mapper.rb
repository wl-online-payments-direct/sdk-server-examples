module Infrastructure
  module Mappers
    module PaymentDetails
      class AddressMapper
        def self.from_sdk_response(response)
          return nil if response.nil?

          dto = Business::Domain::Payments::PaymentDetails::Address.new
          dto.additional_info = response.additional_info
          dto.city = response.city
          dto.country_code = response.country_code
          dto.house_number = response.house_number
          dto.state = response.state
          dto.street = response.street
          dto.zip = response.zip

          dto
        end
      end
    end
  end
end