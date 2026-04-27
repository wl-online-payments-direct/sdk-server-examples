module Business
  module Domain
    module Payments
      module PaymentDetails
        class SurchargeRate
          attr_accessor :ad_valorem_rate, :specific_rate, :surcharge_product_type_id, :surcharge_product_type_version

          def initialize(ad_valorem_rate: nil, specific_rate: nil, surcharge_product_type_id: nil, surcharge_product_type_version: nil)
            @ad_valorem_rate = ad_valorem_rate
            @specific_rate = specific_rate
            @surcharge_product_type_id = surcharge_product_type_id
            @surcharge_product_type_version = surcharge_product_type_version
          end

          def to_h
            {
              'adValoremRate' => @ad_valorem_rate,
              'specificRate' => @specific_rate,
              'surchargeProductTypeId' => @surcharge_product_type_id,
              'surchargeProductTypeVersion' => @surcharge_product_type_version
            }
          end
        end
      end
    end
  end
end