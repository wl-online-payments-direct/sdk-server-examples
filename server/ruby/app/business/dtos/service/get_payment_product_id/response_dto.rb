module Business
  module Dtos
    module Service
      module GetPaymentProductId
        class ResponseDto
          attr_accessor :payment_product_id

          def initialize(payment_product_id = nil)
            @payment_product_id = payment_product_id
          end
        end
      end
    end
  end
end