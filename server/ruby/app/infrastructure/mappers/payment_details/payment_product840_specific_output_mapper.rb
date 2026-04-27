module Infrastructure
  module Mappers
    module PaymentDetails
      class PaymentProduct840SpecificOutputMapper
        def self.from_sdk_response(response)
          return nil if response.nil?

          dto = Business::Domain::Payments::PaymentDetails::PaymentProduct840SpecificOutput.new
          dto.billing_address = Infrastructure::Mappers::PaymentDetails::AddressMapper.from_sdk_response(response.billing_address)
          dto.customer_account = Infrastructure::Mappers::PaymentDetails::PaymentProduct840CustomerAccountMapper.from_sdk_response(response.customer_account)
          dto.customer_address = Infrastructure::Mappers::PaymentDetails::AddressMapper.from_sdk_response(response.customer_address)
          dto.protection_eligibility = Infrastructure::Mappers::PaymentDetails::ProtectionEligibilityMapper.from_sdk_response(response.protection_eligibility)

          dto
        end
      end
    end
  end
end