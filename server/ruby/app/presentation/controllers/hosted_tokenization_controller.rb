module Presentation
  module Controllers
    class HostedTokenizationController < ApplicationController
      inject :hosted_tokenization_service

      def get_hosted_tokenization
        response_dto = hosted_tokenization_service.init_hosted_tokenization

        response_model = Presentation::Mappers::HostedTokenization::HostedTokenizationMapper.from_dto(response_dto)

        render json: Business::Extensions::HashCaseConverter.to_camel_case(response_model.as_json), status: :accepted
      end
    end
  end
end