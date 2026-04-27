module Business
  module Handlers
    class TokenPaymentHandler
      def initialize(payment_client:)
        @payment_client = payment_client
      end

      def supported_method
        Domain::Enums::Payments::PaymentMethodType::TOKEN
      end

      def handle(request_dto)
        @payment_client.create_payment(request_dto)
      end
    end
  end
end
