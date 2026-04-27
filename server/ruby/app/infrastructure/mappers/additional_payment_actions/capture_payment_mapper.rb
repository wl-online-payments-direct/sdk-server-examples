module Infrastructure
  module Mappers
    module AdditionalPaymentActions
      module CapturePaymentMapper
        def self.to_sdk_request(dto)
          request = OnlinePayments::SDK::Domain::CapturePaymentRequest.new
          request.amount = dto.amount
          request.is_final = dto.is_final
          request
        end
        def self.from_sdk_response(response)
          response_dto = Business::Dtos::AdditionalPaymentActions::ResponseDto.new

          response_dto.status =
            response&.status ? Business::Domain::Enums::AdditionalPaymentActions::Status.try_from(response.status) : nil

          response_dto.id = response&.id

          status_output = Business::Domain::Payments::StatusOutput.new
          status_output.status_code = response&.status_output&.status_code
          status_output.status_category = nil

          response_dto.status_output = status_output

          response_dto
        end
      end
    end
  end
end