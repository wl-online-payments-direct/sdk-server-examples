module Presentation
  module Models
    module CreateHostedCheckout
      class Response
        attr_reader :hosted_checkout_id, :redirect_url, :return_mac, :amount, :currency

        def initialize(hosted_checkout_id:, redirect_url:, return_mac:, amount:, currency:)
          @hosted_checkout_id = hosted_checkout_id
          @redirect_url      = redirect_url
          @return_mac        = return_mac
          @amount            = amount
          @currency          = currency
        end

        def as_json(*)
          {
            hostedCheckoutId: hosted_checkout_id,
            redirectUrl: redirect_url,
            returnMAC: return_mac,
            amount: amount,
            currency: currency
          }
        end
      end
    end
  end
end