module Infrastructure
  module Mappers
    module PaymentDetails
      class PersonalNameMapper
        def self.from_sdk_response(response)
          return nil if response.nil?

          Business::Domain::Payments::PaymentDetails::PersonalName.new(
            first_name: response.first_name,
            surname: response.surname,
            title: response.title
          )
        end
      end
    end
  end
end