module Presentation
  module Controllers
    class PaymentController < ApplicationController
      inject :payment_service

      def create_payment

        permitted = permitted_params
        request_params = Business::Extensions::HashCaseConverter.to_snake_case(permitted.to_h)

        validator = Presentation::Validators::Payment::PaymentValidator.new
        validator.validate(request_params)

        request_dto = Presentation::Mappers::PaymentMapper.to_dto(request_params)

        response_dto = payment_service.create_payment(request_dto)

        response_model = Presentation::Mappers::PaymentMapper.from_dto(response_dto)

        render json: Business::Extensions::HashCaseConverter.to_camel_case(response_model.as_json),
               status: :created
      end

      def get_payment_details
        id = params[:id]

        response_dto = payment_service.get_payment_details(id)

        response_model = Presentation::Mappers::PaymentDetailsMapper.from_dto(response_dto)

        render json: Business::Extensions::HashCaseConverter.to_camel_case(response_model.as_json),
               status: :ok
      end

      def capture_payment
        permitted = permitted_additional_params
        request_params = Business::Extensions::HashCaseConverter.to_snake_case(permitted.to_h)

        validator = Presentation::Validators::AdditionalPaymentActions::AdditionalPaymentActionsValidator.new
        validator.validate(request_params)

        id = params[:id]
        request_dto = Presentation::Mappers::AdditionalPaymentActions::AdditionalPaymentActionMapper.to_dto(request_params, id)

        response_dto = payment_service.capture_payment(request_dto)
        response_model = Presentation::Mappers::AdditionalPaymentActions::AdditionalPaymentActionMapper.from_dto(response_dto)

        render json: Business::Extensions::HashCaseConverter.to_camel_case(response_model.as_json),
               status: :ok
      end

      def refund_payment
        permitted = permitted_additional_params
        request_params = Business::Extensions::HashCaseConverter.to_snake_case(permitted.to_h)

        validator = Presentation::Validators::AdditionalPaymentActions::AdditionalPaymentActionsValidator.new
        validator.validate(request_params)

        id = params[:id]
        request_dto = Presentation::Mappers::AdditionalPaymentActions::AdditionalPaymentActionMapper.to_dto(request_params, id)

        response_dto = payment_service.refund_payment(request_dto)
        response_model = Presentation::Mappers::AdditionalPaymentActions::AdditionalPaymentActionMapper.from_dto(response_dto)

        render json: Business::Extensions::HashCaseConverter.to_camel_case(response_model.as_json),
               status: :ok
      end

      def cancel_payment
        permitted = permitted_additional_params
        request_params = Business::Extensions::HashCaseConverter.to_snake_case(permitted.to_h)

        validator = Presentation::Validators::AdditionalPaymentActions::AdditionalPaymentActionsValidator.new
        validator.validate(request_params)

        id = params[:id]
        request_dto = Presentation::Mappers::AdditionalPaymentActions::AdditionalPaymentActionMapper.to_dto(request_params, id)

        response_dto = payment_service.cancel_payment(request_dto)
        response_model = Presentation::Mappers::AdditionalPaymentActions::AdditionalPaymentActionMapper.from_dto(response_dto)

        render json: Business::Extensions::HashCaseConverter.to_camel_case(response_model.as_json),
               status: :ok
      end

      private

      def permitted_params
        params.permit(
          :amount,
          :currency,
          :method,
          :hostedTokenizationId,
          billingAddress: [:firstName, :lastName, :country, :zip, :city, :street],
          shippingAddress: [:firstName, :lastName, :country, :zip, :city, :street],
          card: [:number, :holderName, :verificationCode, :expiryMonth, :expiryYear],
          mandate: [
            :iban,
            :customerReference,
            :mandateReference,
            :recurrenceType,
            :signatureType,
            :returnUrl,
            address: [:firstName, :lastName, :country, :zip, :city, :street]
          ]
        )
      end

      def permitted_additional_params
        params.permit(
          :id,
          :amount,
          :currency,
          :isFinal
        )
      end
    end
  end
end
