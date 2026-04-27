 module Business
  module Domain
    module Payments
      module PaymentDetails
        class CardEssentials
          attr_accessor :bin, :card_number, :country_code, :expiry_date

          def initialize(bin: nil, card_number: nil, country_code: nil, expiry_date: nil)
            @bin = bin
            @card_number = card_number
            @country_code = country_code
            @expiry_date = expiry_date
          end

          def to_h
            {
              'bin' => @bin,
              'cardNumber' => @card_number,
              'countryCode' => @country_code,
              'expiryDate' => @expiry_date
            }
          end
        end
      end
    end
  end
end