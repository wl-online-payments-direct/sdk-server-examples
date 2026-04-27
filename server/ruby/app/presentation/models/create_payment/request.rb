module Presentation
  module Models
    module CreatePayment
      class Request
        attr_accessor :amount,
                      :currency,
                      :method,
                      :hosted_tokenization_id,
                      :shipping_address,
                      :billing_address,
                      :card,
                      :mandate

        def initialize(amount: nil,
                       currency: nil,
                       method: nil,
                       hosted_tokenization_id: nil,
                       shipping_address: nil,
                       billing_address: nil,
                       card: nil,
                       mandate: nil)
          @amount = amount
          @currency = currency
          @method = method
          @hosted_tokenization_id = hosted_tokenization_id
          @shipping_address = shipping_address
          @billing_address = billing_address
          @card = card
          @mandate = mandate
        end
      end
    end
  end
end