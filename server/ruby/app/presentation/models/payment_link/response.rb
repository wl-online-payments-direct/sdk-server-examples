module Presentation
  module Models
    module PaymentLink
      class Response
        attr_accessor :payment_link_id, :redirect_url, :status, :amount, :currency

        def initialize(payment_link_id: nil, redirect_url: nil, status: nil, amount: nil, currency: nil)
          @payment_link_id = payment_link_id
          @redirect_url    = redirect_url
          @status          = status
          @amount          = amount
          @currency        = currency
        end

        def as_json(*)
          {
            payment_link_id: @payment_link_id,
            redirect_url:    @redirect_url,
            status:          @status&.to_s,
            amount:          @amount,
            currency:        @currency&.to_s
          }
        end

        def to_json(*options)
          as_json.to_json(*options)
        end
      end
    end
  end
end