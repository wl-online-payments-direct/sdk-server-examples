module Presentation
  module Controllers
    class HostedCheckoutController < ApplicationController
      inject :hosted_checkout_service

      def create_hosted_checkout_sessions
        permitted = permitted_params
        request_params = Business::Extensions::HashCaseConverter.to_snake_case(permitted.to_h)

        validator = Presentation::Validators::HostedCheckout::HostedCheckoutValidator.new
        validator.validate(request_params)

        request_dto = Presentation::Mappers::HostedCheckout::HostedCheckoutMapper.to_dto(request_params)
        response_dto = hosted_checkout_service.create_hosted_checkout(request_dto)
        response_model = Presentation::Mappers::HostedCheckout::HostedCheckoutMapper.from_dto(response_dto)

        render json: Business::Extensions::HashCaseConverter.to_camel_case(response_model.as_json), status: :created
      end

      def get_payment_by_hosted_checkout_id
        id = params[:id]

        response_dto = hosted_checkout_service.get_payment_by_hosted_checkout_id(id)
        response_model = Presentation::Mappers::HostedCheckout::HostedCheckoutMapper.from_get_payment_dto(response_dto)

        render json: Business::Extensions::HashCaseConverter.to_camel_case(response_model.as_json),
               status: :ok
      end

      private

      def permitted_params
        params.permit(
          :amount,
          :currency,
          :language,
          :redirectUrl,
          billingAddress: [:firstName, :lastName, :country, :zip, :city, :street],
          shippingAddress: [:firstName, :lastName, :country, :zip, :city, :street]
        )
      end
    end
  end
end