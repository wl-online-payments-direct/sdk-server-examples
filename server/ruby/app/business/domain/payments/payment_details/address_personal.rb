module Business
  module Domain
    module Payments
      module PaymentDetails
        class AddressPersonal
          attr_accessor :additional_info, :city, :company_name, :country_code,
                        :house_number, :name, :state, :street, :zip

          def initialize(additional_info: nil, city: nil, company_name: nil,
                         country_code: nil, house_number: nil, name: nil,
                         state: nil, street: nil, zip: nil)
            @additional_info = additional_info
            @city = city
            @company_name = company_name
            @country_code = country_code
            @house_number = house_number
            @name = name
            @state = state
            @street = street
            @zip = zip
          end

          def to_h
            {
              'additionalInfo' => @additional_info,
              'city' => @city,
              'companyName' => @company_name,
              'countryCode' => @country_code,
              'houseNumber' => @house_number,
              'name' => @name&.to_h,
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