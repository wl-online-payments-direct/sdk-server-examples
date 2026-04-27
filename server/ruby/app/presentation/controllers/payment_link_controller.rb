module Presentation
  module Controllers
    class PaymentLinkController < ApplicationController
      inject :payment_link_service

      def create_payment_link
        body_action = request.request_parameters['action']

        permitted = payment_link_params
        permitted_hash = permitted.to_h

        permitted_hash.delete('action') unless request.request_parameters.key?('action')

        permitted_hash['action'] = body_action if body_action.present?

        request_params = Business::Extensions::HashCaseConverter.to_snake_case(permitted_hash)

        validator = Presentation::Validators::PaymentLink::PaymentLinkValidator.new
        validator.validate(request_params)

        request_dto = Presentation::Mappers::PaymentLink::PaymentLinkMapper.to_dto(request_params)
        response_dto = payment_link_service.create_payment_link(request_dto)
        response_model = Presentation::Mappers::PaymentLink::PaymentLinkMapper.from_dto(response_dto)

        render json: Business::Extensions::HashCaseConverter.to_camel_case(response_model.as_json), status: :created
      end

      private

      def payment_link_params
        params.permit(
          :amount,
          :currency,
          :description,
          :validFor,
          :action
        )
      end
    end
  end
end