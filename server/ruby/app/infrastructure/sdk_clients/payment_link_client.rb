module Infrastructure
  module SdkClients
    class PaymentLinkClient
      attr_reader :merchant_client, :logger

      def initialize(merchant_client:, logger: Rails.logger)
        @merchant_client = merchant_client
        @logger = logger
      end

      def create_payment_link(request_dto)
        sdk_request = Infrastructure::Mappers::PaymentLinkMapper.to_sdk_request(request_dto)

        amount   = sdk_request.order&.amount_of_money&.amount
        currency = sdk_request.order&.amount_of_money&.currency_code
        logger.info("Creating payment link - Amount: #{amount}; Currency: #{currency}.")

        sdk_response = merchant_client.payment_links.create_payment_link(sdk_request)

        redirect_url = sdk_response&.redirection_url
        logger.info("Payment link created successfully - Redirect URL: #{redirect_url}.")

        Infrastructure::Mappers::PaymentLinkMapper.from_sdk_response(sdk_response)
      rescue StandardError => e
        @logger.error("Error occurred while creating payment: #{e.message}")
        raise Infrastructure::Mappers::ExceptionMapper.map(e)
      end
    end
  end
end