module Business
  module Dtos
    module AdditionalPaymentActions
      class RequestDto
        attr_accessor :amount, :currency, :is_final, :id

        def initialize(id:, amount: nil, currency: nil, is_final: nil)
          @id = id
          @amount = amount
          @currency = currency
          @is_final = is_final
        end
        def to_h
          {
            id: id,
            amount: amount,
            currency: currency,
            is_final: is_final
          }.compact
        end
      end
    end
  end
end