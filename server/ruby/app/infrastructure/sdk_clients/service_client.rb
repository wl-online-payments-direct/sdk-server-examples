module Infrastructure
  module SDKClients
    class ServiceClient
      def initialize(merchant_client:, logger: Rails.logger)
        @merchant_client = merchant_client
        @logger = logger
      end

      def get_payment_product_id(request_dto)
        begin
          @logger.info("Fetching the payment product id for card number: #{request_dto.card_number}")

          sdk_request = Infrastructure::Mappers::ServiceMapper.to_sdk_request(request_dto)

          sdk_response = @merchant_client.services.get_iin_details(sdk_request)

          if sdk_response.payment_product_id.nil?
            @logger.info("No valid payment product id found for card number: #{request_dto.card_number}")
          end

          @logger.info("Payment product id: #{sdk_response.payment_product_id} returned for card number: #{request_dto.card_number}")

          Infrastructure::Mappers::ServiceMapper.from_sdk_response(sdk_response)
        rescue StandardError => e
          @logger.error("Error occurred while getting payment product id: #{e.message}")
          raise Infrastructure::Mappers::ExceptionMapper.map(e)
        end
      end
    end
  end
end
