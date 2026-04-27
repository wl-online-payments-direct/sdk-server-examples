module Business
  module Domain
    module Payments
      class Card
        attr_accessor :number,
                      :holder_name,
                      :verification_code,
                      :expiry_month,
                      :expiry_year

        def initialize(number: nil,
                       holder_name: nil,
                       verification_code: nil,
                       expiry_month: nil,
                       expiry_year: nil)
          @number = number
          @holder_name = holder_name
          @verification_code = verification_code
          @expiry_month = expiry_month
          @expiry_year = expiry_year
        end

        def self.from_sdk_hash(hash)
          return nil unless hash.is_a?(Hash)

          new(
            number: hash['number'],
            holder_name: hash['holder_name'],
            verification_code: hash['verification_code'],
            expiry_month: hash['expiry_month'],
            expiry_year: hash['expiry_year']
          )
        end

        def to_sdk_hash
          {
            'number' => @number,
            'holderName' => @holder_name,
            'verificationCode' => @verification_code,
            'expiryMonth' => @expiry_month,
            'expiryYear' => @expiry_year
          }
        end
      end
    end
  end
end