module Infrastructure
  module Mappers
    module AdditionalPaymentActions
      module AmountOfMoneyMapper
        def self.map(dto)
          return nil if dto.amount.nil? || dto.currency.nil?

          amount_of_money = OnlinePayments::SDK::Domain::AmountOfMoney.new
          amount_of_money.amount = dto.amount
          amount_of_money.currency_code = dto.currency.is_a?(String) ? dto.currency : dto.currency&.value

          amount_of_money
        end
      end
    end
  end
end
