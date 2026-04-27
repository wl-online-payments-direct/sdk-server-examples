module Infrastructure
  module Mappers
    module PaymentDetails
      class AmountOfMoneyMapper
        def self.from_sdk_response(response)
          return nil if response.nil?

          dto = Business::Domain::Payments::PaymentDetails::AmountOfMoney.new
          dto.amount = response.amount
          dto.currency_code = response.currency_code

          dto
        end
      end
    end
  end
end