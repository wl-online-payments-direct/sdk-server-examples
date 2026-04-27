module Business
  module Dtos
    module HostedTokenization
      class ResponseDto
        attr_accessor :hosted_tokenization_id, :hosted_tokenization_url

        def initialize(hosted_tokenization_id: nil, hosted_tokenization_url: nil)
          @hosted_tokenization_id  = hosted_tokenization_id
          @hosted_tokenization_url = hosted_tokenization_url
        end
      end
    end
  end
end
