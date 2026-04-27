module Infrastructure
  module Mappers
    module AdditionalPaymentActions
      module CancelPaymentMapper
        def self.to_sdk_request(dto)
          request = OnlinePayments::SDK::Domain::CancelPaymentRequest.new
          request.amount_of_money = Infrastructure::Mappers::AdditionalPaymentActions::AmountOfMoneyMapper.map(dto)
          request
        end
        def self.from_sdk_response(response)
          response_dto = Business::Dtos::AdditionalPaymentActions::ResponseDto.new

          payment = response&.payment

          response_dto.status =
            payment&.status ? Business::Domain::Enums::AdditionalPaymentActions::Status.try_from(payment.status) : nil

          response_dto.id = payment&.id

          status_output = Business::Domain::Payments::StatusOutput.new
          status_output.status_code = payment&.status_output&.status_code
          status_output.status_category =
            payment&.status_output&.status_category ?
              Business::Domain::Enums::Common::StatusCategory.try_from(
                payment.status_output.status_category
              ) :
              nil

          response_dto.status_output = status_output

          response_dto
        end

      end
    end
  end
end
