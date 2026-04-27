module Infrastructure
  module Mappers
    module PaymentDetails
      class CustomerOutputMapper
        def self.from_sdk_response(response)
          return nil if response.nil?

          dto = Business::Domain::Payments::PaymentDetails::CustomerOutput.new
          dto.device = Infrastructure::Mappers::PaymentDetails::CustomerDeviceOutputMapper.from_sdk_response(response.device)

          dto
        end
      end
    end
  end
end