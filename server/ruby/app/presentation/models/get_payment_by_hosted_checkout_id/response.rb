module Presentation
  module Models
    module GetPaymentByHostedCheckoutId
      class Response
        attr_accessor :status, :payment_id

        def initialize(status: nil, payment_id: nil)
          @status = status
          @payment_id = payment_id
        end

        def as_json(*)
          { status: status, payment_id: payment_id }
        end
      end
    end
  end
end