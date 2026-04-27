module Business
  module Services
    module Payment
      class PaymentService
        attr_reader :payment_client, :handlers

        def initialize(payment_client:, handlers:)
          @payment_client = payment_client
          @handlers = handlers
        end

        def create_payment(request_dto)
          handler = handlers.find do |h|
            h.supported_method.to_s == request_dto.method.to_s
          end

          handler.handle(request_dto)
        end

        def capture_payment(request_dto)
          @payment_client.capture_payment(request_dto)
        end

        def refund_payment(request_dto)
          @payment_client.refund_payment(request_dto)
        end

        def cancel_payment(request_dto)
          @payment_client.cancel_payment(request_dto)
        end

        def get_payment_details(id)
          @payment_client.get_payment_details(id)
        end
      end
    end
  end
end
