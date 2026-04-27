module Presentation
  module Models
    module HostedTokenization
      class Response
        attr_reader :hosted_tokenization_id, :hosted_tokenization_url

        def initialize(hosted_tokenization_id:, hosted_tokenization_url:)
          @hosted_tokenization_id  = hosted_tokenization_id
          @hosted_tokenization_url = hosted_tokenization_url
        end

        def as_json(*)
          {
            hostedTokenizationId: hosted_tokenization_id,
            hostedTokenizationUrl: hosted_tokenization_url
          }
        end
      end
    end
  end
end
