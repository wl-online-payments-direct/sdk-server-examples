module Business
  module Domain
    module Payments
      module PaymentDetails
        class CustomerDeviceOutput
          attr_accessor :ip_address_country_code

          def initialize(ip_address_country_code: nil)
            @ip_address_country_code = ip_address_country_code
          end

          def to_h
            {
              'ipAddressCountryCode' => @ip_address_country_code
            }
          end
        end
      end
    end
  end
end
