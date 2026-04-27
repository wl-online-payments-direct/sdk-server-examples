module Business
  module Handlers
    class CreditCardPaymentHandler
      def initialize(payment_client:, service_client:)
        @payment_client = payment_client
        @service_client = service_client
      end

      def supported_method
        Business::Domain::Enums::Payments::PaymentMethodType::CREDIT_CARD
      end

      def handle(request_dto)

        get_payment_product_id_request = Business::Dtos::Service::GetPaymentProductId::RequestDto.new(
          request_dto.card.number
        )

        get_payment_product_id_response = @service_client.get_payment_product_id(get_payment_product_id_request)

        request_dto.payment_product_id = get_payment_product_id_response.payment_product_id

        @payment_client.create_payment(request_dto)
      end
    end
  end
end
