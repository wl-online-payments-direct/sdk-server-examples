module Infrastructure
  module Mappers
    module HostedTokenizationMapper
      module_function

      def from_sdk_response(sdk_response)
        return nil unless sdk_response

        Business::Dtos::HostedTokenization::ResponseDto.new(
          hosted_tokenization_id: sdk_response.hosted_tokenization_id,
          hosted_tokenization_url: normalize_hosted_tokenization_url(sdk_response.hosted_tokenization_url)
        )
      end

      def normalize_hosted_tokenization_url(url)
        return nil if url.nil?

        url.sub(/:\d+/, '')
      end

      module_function :normalize_hosted_tokenization_url
    end
  end
end