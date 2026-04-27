module Infrastructure
  module SdkClients
    class PaymentClient
      attr_reader :merchant_client, :logger

      def initialize(merchant_client:, logger: Rails.logger)
        @merchant_client = merchant_client
        @logger = logger
      end

      def create_payment(request_dto)
        sdk_request = Infrastructure::Mappers::PaymentMapper.to_sdk_request(request_dto)

        if sdk_request.order&.amount_of_money
          amount   = sdk_request.order.amount_of_money.amount
          currency = sdk_request.order.amount_of_money.currency_code
          logger.info("Creating payment request - Amount: #{amount}; Currency: #{currency}.")
        end

        sdk_response = merchant_client.payments.create_payment(sdk_request)

        payment_id = sdk_response&.payment&.id
        payment_status = sdk_response&.payment&.status

        logger.info("Payment created successfully - Payment ID: #{payment_id || 'N/A'}; Status: #{payment_status || 'N/A'}.")

        Infrastructure::Mappers::PaymentMapper.from_sdk_response(sdk_response)
      rescue StandardError => e
        @logger.error("Error occurred while creating payment: #{e.message}")
        raise Infrastructure::Mappers::ExceptionMapper.map(e)
      end

      def cancel_payment(request_dto)
        sdk_request = Infrastructure::Mappers::AdditionalPaymentActions::CancelPaymentMapper.to_sdk_request(request_dto)

        amount = sdk_request&.amount_of_money&.amount
        logger.info("The payment cancellation for payment with id: #{request_dto.id} has started; Amount: #{amount}.")

        sdk_response = merchant_client.payments.cancel_payment(request_dto.id, sdk_request)

        logger.info("Payment successfully cancelled for payment with id: #{request_dto.id}.")

        Infrastructure::Mappers::AdditionalPaymentActions::CancelPaymentMapper.from_sdk_response(sdk_response)
      rescue StandardError => e
        logger.error("Error occurred while canceling payment: #{e.message} (payment_id: #{request_dto.id})")
        raise Infrastructure::Mappers::ExceptionMapper.map(e)
      end

      def capture_payment(request_dto)
        sdk_request = Infrastructure::Mappers::AdditionalPaymentActions::CapturePaymentMapper.to_sdk_request(request_dto)

        amount = sdk_request&.amount
        logger.info("The payment capture for payment with id: #{request_dto.id} has started; Amount: #{amount}.")

        sdk_response = merchant_client.payments.capture_payment(request_dto.id, sdk_request)

        logger.info("Payment successfully captured for payment with id: #{request_dto.id}.")

        Infrastructure::Mappers::AdditionalPaymentActions::CapturePaymentMapper.from_sdk_response(sdk_response)
      rescue StandardError => e
        logger.error("Error occurred while capturing payment: #{e.message} (payment_id: #{request_dto.id})")
        raise Infrastructure::Mappers::ExceptionMapper.map(e)
      end

      def refund_payment(request_dto)
        sdk_request = Infrastructure::Mappers::AdditionalPaymentActions::RefundPaymentMapper.to_sdk_request(request_dto)

        amount = sdk_request&.amount_of_money&.amount
        logger.info("The payment refund for payment with id: #{request_dto.id} has started; Amount: #{amount}.")

        sdk_response = merchant_client.payments.refund_payment(request_dto.id, sdk_request)

        logger.info("Payment successfully refunded for payment with id: #{request_dto.id}.")

        Infrastructure::Mappers::AdditionalPaymentActions::RefundPaymentMapper.from_sdk_response(sdk_response)
      rescue StandardError => e
        logger.error("Error occurred while refunding payment: #{e.message} (payment_id: #{request_dto.id})")
        raise Infrastructure::Mappers::ExceptionMapper.map(e)
      end

      def get_payment_details(id)
        logger.info("The fetch payment details with id: #{id} has started.")

        sdk_response = merchant_client.payments.get_payment_details(id)

        logger.info("Payment details retrieved successfully for payment with id: #{id}.")

        Infrastructure::Mappers::PaymentDetailsMapper.from_sdk_response(sdk_response)
      rescue StandardError => e
        logger.error("Error occurred while getting payment details: #{e.message} (payment_id: #{id})")
        raise Infrastructure::Mappers::ExceptionMapper.map(e)
      end
    end
  end
end