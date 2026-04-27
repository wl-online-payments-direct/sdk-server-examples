module Business
  module Dtos
    module Common
      class Address
        attr_accessor :first_name, :last_name, :country, :zip, :city, :street

        def initialize(first_name: nil, last_name: nil, country: nil, zip: nil, city: nil, street: nil)
          @first_name = first_name
          @last_name  = last_name
          @country    = country
          @zip        = zip
          @city       = city
          @street     = street
        end

        def to_sdk_hash
          {
            "firstName"   => @first_name,
            "lastName"    => @last_name,
            "country"     => @country,
            "zip"         => @zip,
            "city"        => @city,
            "street"      => @street
          }.compact
        end

        def self.from_sdk_hash(hash)
          new(
            first_name: hash[:first_name],
            last_name:  hash[:last_name],
            country:    hash[:country],
            zip:        hash[:zip],
            city:       hash[:city],
            street:     hash[:street]
          )
        end
      end
    end
  end
end