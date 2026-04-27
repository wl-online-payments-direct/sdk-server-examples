module Presentation
  module Models
    module CreateHostedCheckout
      class Request
        attr_accessor :amount, :currency, :language, :redirect_url, :billing_address, :shipping_address

        def initialize(amount: nil, currency: nil, language: nil, redirect_url: nil, billing_address: nil, shipping_address: nil)
          @amount           = amount
          @currency         = currency
          @language         = language
          @redirect_url     = redirect_url
          @billing_address  = billing_address
          @shipping_address = shipping_address
        end
      end
    end
  end
end