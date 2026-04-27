module Business
  module Dtos
    module PaymentLink
      class ResponseDto
        attr_accessor :redirect_url, :payment_link_id, :status, :amount, :currency

        def initialize(redirect_url: nil, payment_link_id: nil, status: nil, amount: nil, currency: nil)
          @redirect_url     = redirect_url
          @payment_link_id  = payment_link_id
          @status           = status
          @amount           = amount
          @currency         = currency
        end
      end
    end
  end
end