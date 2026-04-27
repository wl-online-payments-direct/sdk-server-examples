module Infrastructure
  module Mappers
    module PaymentDetails
      class PaymentProduct840CustomerAccountMapper
        def self.from_sdk_response(response)
          return nil if response.nil?

          dto = Business::Domain::Payments::PaymentDetails::PaymentProduct840CustomerAccount.new
          dto.account_id = response.account_id
          dto.company_name = response.company_name
          dto.country_code = response.country_code
          dto.first_name = response.first_name
          dto.customer_account_status = response.customer_account_status
          dto.customer_address_status = response.customer_address_status
          dto.payer_id = response.payer_id
          dto.surname = response.surname

          dto
        end
      end
    end
  end
end