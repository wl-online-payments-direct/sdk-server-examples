module Business
  module Handlers
    class DirectDebitPaymentHandler
      DIRECT_DEBIT_PRODUCT_ID = 771

      def initialize(payment_client:, mandate_client:)
        @payment_client = payment_client
        @mandate_client = mandate_client
      end

      def supported_method
        Domain::Enums::Payments::PaymentMethodType::DIRECT_DEBIT
      end

      def handle(request_dto)
        ensure_mandate!(request_dto)

        request_dto.payment_product_id = DIRECT_DEBIT_PRODUCT_ID

        @payment_client.create_payment(request_dto)
      end

      private

      def ensure_mandate!(request_dto)
        mandate = request_dto.mandate

        existing_mandate = nil
        mandate_reference = mandate&.mandate_reference

        if mandate_reference && !mandate_reference.empty?
          existing_mandate = @mandate_client.get_mandate(mandate_reference)
        end

        if existing_mandate.nil?
          new_mandate = @mandate_client.create_mandate(request_dto)
          request_dto.mandate = new_mandate
        else
          request_dto.mandate ||= mandate
          request_dto.mandate.mandate_reference = existing_mandate.mandate_reference
        end
      end
    end
  end
end
