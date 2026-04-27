module Infrastructure
  module Mappers
    module PaymentDetails
      class CustomerDeviceOutputMapper
        def self.from_sdk_response(response)
          return nil if response.nil?

          dto = Business::Domain::Payments::PaymentDetails::CustomerDeviceOutput.new
          dto.ip_address_country_code = response.ip_address_country_code

          dto
        end
      end
    end
  end
end