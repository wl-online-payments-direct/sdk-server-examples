module Infrastructure
  module Mappers
    module PaymentDetails
      class ApiErrorMapper
        def self.from_sdk_response(response)
          return nil if response.nil?

          dto = Business::Domain::Payments::PaymentDetails::APIError.new
          dto.message = response.message
          dto.error_code = response.error_code
          dto.property_name = response.property_name
          dto.http_status_code = response.http_status_code
          dto.retriable = response.retriable
          dto.category = response.category
          dto.id = response.id

          dto
        end
      end
    end
  end
end