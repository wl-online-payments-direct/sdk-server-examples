module Presentation
  module Models
    module PaymentLink
      class Request
        attr_accessor :amount, :currency, :description, :valid_for, :action

        def initialize(amount: nil, currency: nil, description: nil, valid_for: nil, action: nil)
          @amount      = amount
          @currency    = currency
          @description = description
          @valid_for   = valid_for
          @action      = action
        end
      end
    end
  end
end