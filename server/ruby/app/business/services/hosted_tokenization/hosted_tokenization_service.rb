module Business
  module Services
    module HostedTokenization
      class HostedTokenizationService
        def initialize(hosted_tokenization_client:)
          @hosted_tokenization_client = hosted_tokenization_client
        end

        def init_hosted_tokenization
          @hosted_tokenization_client.init_hosted_tokenization
        end
      end
    end
  end
end