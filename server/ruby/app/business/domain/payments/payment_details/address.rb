module Business
  module Domain
    module Payments
      module PaymentDetails
        class Address
          attr_accessor :additional_info, :city, :country_code,
                        :house_number, :state, :street, :zip

          def initialize(additional_info: nil, city: nil, country_code: nil,
                         house_number: nil, state: nil, street: nil, zip: nil)
            @additional_info = additional_info
            @city = city
            @country_code = country_code
            @house_number = house_number
            @state = state
            @street = street
            @zip = zip
          end

          def to_h
            {
              'additionalInfo' => @additional_info,
              'city' => @city,
              'countryCode' => @country_code,
              'houseNumber' => @house_number,
              'state' => @state,
              'street' => @street,
              'zip' => @zip
            }
          end
        end
      end
    end
  end
end