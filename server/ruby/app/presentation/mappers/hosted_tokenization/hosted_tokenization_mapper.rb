module Presentation
  module Mappers
    module HostedTokenization
      module HostedTokenizationMapper
        module_function

        def from_dto(dto)
          return nil unless dto

          Presentation::Models::HostedTokenization::Response.new(
            hosted_tokenization_id: dto.hosted_tokenization_id,
            hosted_tokenization_url: dto.hosted_tokenization_url
          )
        end
      end
    end
  end
end