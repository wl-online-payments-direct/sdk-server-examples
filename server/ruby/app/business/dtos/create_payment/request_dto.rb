module Business
  module Dtos
    module CreatePayment
      class RequestDto
        attr_accessor :amount,
                      :currency,
                      :method,
                      :hosted_tokenization_id,
                      :shipping_address,
                      :billing_address,
                      :card,
                      :mandate,
                      :payment_product_id
        def initialize(
          amount: nil,
          currency: nil,
          method: nil,
          hosted_tokenization_id: nil,
          shipping_address: nil,
          billing_address: nil,
          card: nil,
          mandate: nil,
          payment_product_id: nil
        )
          @amount = amount
          @currency = currency
          @method = method
          @hosted_tokenization_id = hosted_tokenization_id
          @shipping_address = shipping_address
          @billing_address = billing_address
          @card = card
          @mandate = mandate
          @payment_product_id = payment_product_id
        end

        def self.from_sdk_hash(hash)
          new(
            amount: hash['amount'],
            currency: hash['currency'],
            method: hash['method'],
            hosted_tokenization_id: hash['hosted_tokenization_id'],
            shipping_address: hash['shipping_address'] ? Business::Dtos::Common::Address.from_hash(hash['shipping_address']) : nil,
            billing_address: hash['billing_address'] ? Business::Dtos::Common::Address.from_hash(hash['billing_address']) : nil,
            card: hash['card'] ? Business::Domain::Payments::Card.new.from_hash(hash['card']) : nil,
            mandate: hash['mandate'] ? Business::Domain::Payments::Mandate.new.from_hash(hash['mandate']) : nil,
            payment_product_id: hash['payment_product_id']
            )
        end

        def to_sdk_hash
          {
            'amount' => @amount,
            'currency' => @currency,
            'method' => @method,
            'hosted_tokenization_id' => @hosted_tokenization_id,
            'shipping_address' => @shipping_address&.to_h,
            'billing_address' => @billing_address&.to_h,
            'card' => @card&.to_h,
            'mandate' => @mandate&.to_h,
            'payment_product_id' => @payment_product_id
          }
        end
      end
    end
  end
end
