module Infrastructure
  module Mappers
    module PaymentDetails
      class SurchargeRateMapper
        def self.from_sdk_response(response)
          return nil if response.nil?

          Business::Domain::Payments::PaymentDetails::SurchargeRate.new(
            specific_rate: response.specific_rate,
            ad_valorem_rate: response.ad_valorem_rate,
            surcharge_product_type_version: response.surcharge_product_type_version,
            surcharge_product_type_id: response.surcharge_product_type_id
          )
        end
      end
    end
  end
end
