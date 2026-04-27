module Infrastructure
  module Mappers
    module PaymentDetails
      class MobilePaymentDataMapper
        def self.from_sdk_response(response)
          return nil if response.nil?

          dto = Business::Domain::Payments::PaymentDetails::MobilePaymentData.new
          dto.dpan = response.dpan
          dto.expiry_date = response.expiry_date

          dto
        end
      end
    end
  end
end