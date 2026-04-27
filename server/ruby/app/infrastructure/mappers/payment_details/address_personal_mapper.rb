module Infrastructure
  module Mappers
    module PaymentDetails
      class AddressPersonalMapper
        def self.from_sdk_response(response)
          return nil if response.nil?

          Business::Domain::Payments::PaymentDetails::AddressPersonal.new(
            additional_info: response.additional_info,
            city: response.city,
            company_name: response.company_name,
            country_code: response.country_code,
            house_number: response.house_number,
            name: Infrastructure::Mappers::PaymentDetails::PersonalNameMapper.from_sdk_response(response.name),
            state: response.state,
            street: response.street,
            zip: response.zip
          )
        end
      end
    end
  end
end