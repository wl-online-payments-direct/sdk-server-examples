module Infrastructure
  module Mappers
    module PaymentDetails
      class DiscountMapper
        def self.from_sdk_response(response)
          return nil if response.nil?

          dto = Business::Domain::Payments::PaymentDetails::Discount.new
          dto.amount = response.amount

          dto
        end
      end
    end
  end
end