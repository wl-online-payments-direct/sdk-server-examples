module Infrastructure
  module Mappers
    module PaymentDetails
      class PaymentProduct3203SpecificOutputMapper
        def self.from_sdk_response(response)
          return nil if response.nil?

          dto = Business::Domain::Payments::PaymentDetails::PaymentProduct3203SpecificOutput.new
          dto.billing_address = Infrastructure::Mappers::PaymentDetails::AddressPersonalMapper.from_sdk_response(response.billing_address)
          dto.shipping_address = Infrastructure::Mappers::PaymentDetails::AddressPersonalMapper.from_sdk_response(response.shipping_address)

          dto
        end
      end
    end
  end
end
