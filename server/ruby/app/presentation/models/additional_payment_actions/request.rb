module Presentation
  module Models
    module AdditionalPaymentActions
      class Request
        attr_accessor :amount, :currency, :is_final

        def initialize(amount: nil, currency: nil, is_final: nil)
          @amount = amount
          @currency = currency
          @is_final = is_final
        end

        def self.from_request(params)
          new(
            amount: params[:amount]&.to_i,
            currency: params[:currency] ? Application::Domain::Enums::Common::Currency.const_get(params[:currency]) : nil,
            is_final: params[:isFinal]
          )
        end

        def to_h
          {
            amount: amount,
            currency: currency&.to_s,
            isFinal: is_final
          }
        end
      end
    end
  end
end
