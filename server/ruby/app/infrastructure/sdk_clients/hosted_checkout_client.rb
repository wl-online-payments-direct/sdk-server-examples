module Infrastructure
  module SdkClients
    class HostedCheckoutClient
      def initialize(merchant_client:, logger: Rails.logger)
        @merchant_client = merchant_client
        @logger = logger
      end

      def create_hosted_checkout(request_dto)
        sdk_request = Infrastructure::Mappers::HostedCheckoutMapper.to_sdk_request(request_dto)

        @logger.info "Creating hosted checkout - Request: #{sdk_request.inspect}"

        sdk_response = @merchant_client.hosted_checkout.create_hosted_checkout(sdk_request)

        @logger.info "Hosted checkout created - Redirect URL: #{sdk_response.redirect_url}"

        Infrastructure::Mappers::HostedCheckoutMapper.from_sdk_create_response(sdk_response)
      rescue StandardError => e
        @logger.error("Error occurred while creating hosted checkout: #{e.message}")
        raise Infrastructure::Mappers::ExceptionMapper.map(e)
      end

      def get_payment_by_hosted_checkout_id(id)
        @logger.info("Get details for payment with hosted checkout id: #{id} has started.")

        sdk_response = @merchant_client.hosted_checkout.get_hosted_checkout(id)

        @logger.info("Payment details retrieved successfully.")

        Infrastructure::Mappers::HostedCheckoutMapper.from_sdk_get_response(sdk_response)
      rescue StandardError => e
        @logger.error("Error occurred while getting payment: #{e.message}")
        raise Infrastructure::Mappers::ExceptionMapper.map(e)
      end
    end
  end
end