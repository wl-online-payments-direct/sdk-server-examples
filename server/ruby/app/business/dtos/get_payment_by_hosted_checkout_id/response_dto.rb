module Business
  module Dtos
    module GetPaymentByHostedCheckoutId
      class ResponseDto
        attr_accessor :status, :payment_id

        def initialize(status: nil, payment_id: nil)
          @status = status
          @payment_id = payment_id
        end
      end
    end
  end
end