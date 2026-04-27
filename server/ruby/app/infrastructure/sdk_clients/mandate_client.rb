module Infrastructure
  module SdkClients
    class MandateClient
      def initialize(merchant_client:, logger: Rails.logger)
        @merchant_client = merchant_client
        @logger = logger
      end

      def create_mandate(request_dto)
        begin
          @logger.info("Creating new mandate")

          sdk_request = Infrastructure::Mappers::MandateMapper.to_sdk_request(request_dto)

          sdk_response = @merchant_client.mandates.create_mandate(sdk_request)

          @logger.info("Mandate created successfully")

          Infrastructure::Mappers::MandateMapper.from_sdk_create_response(sdk_response)
        rescue StandardError => e
          @logger.error("Error occurred while creating mandate: #{e.message}")
          raise Infrastructure::Mappers::ExceptionMapper.map(e)
        end
      end

      def get_mandate(mandate_reference)
        return nil if mandate_reference.nil?

        begin
          @logger.info("Fetching mandate with reference: #{mandate_reference}")

          sdk_response = @merchant_client.mandates.get_mandate(mandate_reference)

          if sdk_response&.mandate&.unique_mandate_reference.nil?
            @logger.info("Mandate with reference #{mandate_reference} not found.")
            return nil
          end

          @logger.info("Mandate with reference #{mandate_reference} found.")

          Infrastructure::Mappers::MandateMapper.from_sdk_get_response(sdk_response)
        rescue StandardError => e
          @logger.error("Error occurred while getting mandate: #{e.message}")
          raise Infrastructure::Mappers::ExceptionMapper.map(e)
        end
      end
    end
  end
end