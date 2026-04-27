module Infrastructure
  module SdkClients
    class HostedTokenizationClient
      def initialize(merchant_client:, logger: Rails.logger)
        @merchant_client = merchant_client
        @logger = logger
      end

      def init_hosted_tokenization
        @logger.info 'The generation of the hosted tokenization ID has started.'

        sdk_request = OnlinePayments::SDK::Domain::CreateHostedTokenizationRequest.new

        sdk_response = @merchant_client.hosted_tokenization.create_hosted_tokenization(sdk_request)

        @logger.info "Generation of the hosted tokenization ID successfully completed - HostedTokenizationId: #{sdk_response.hosted_tokenization_id}."

        Infrastructure::Mappers::HostedTokenizationMapper.from_sdk_response(sdk_response)
      rescue StandardError => e
        @logger.error("Error occurred while creating hosted tokenization: #{e.message}")
        raise Infrastructure::Mappers::ExceptionMapper.map(e)
      end
    end
  end
end
