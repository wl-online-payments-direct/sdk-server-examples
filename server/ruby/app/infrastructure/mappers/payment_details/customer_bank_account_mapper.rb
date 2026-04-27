module Infrastructure
  module Mappers
    module PaymentDetails
      class CustomerBankAccountMapper
        def self.from_sdk_response(response)
          return nil if response.nil?

          dto = Business::Domain::Payments::PaymentDetails::CustomerBankAccount.new
          dto.account_holder_name = response.account_holder_name
          dto.bic = response.bic
          dto.iban = response.iban

          dto
        end
      end
    end
  end
end