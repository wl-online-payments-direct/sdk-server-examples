module Business
    module Dtos
    module CreateHostedCheckout
      class ResponseDto
        attr_accessor :hosted_checkout_id, :redirect_url, :return_mac, :amount, :currency

        def initialize(hosted_checkout_id: nil, redirect_url: nil, return_mac: nil, amount: nil, currency: nil)
          @hosted_checkout_id = hosted_checkout_id
          @redirect_url       = redirect_url
          @return_mac         = return_mac
          @amount             = amount
          @currency           = currency
        end
      end
    end
  end
end