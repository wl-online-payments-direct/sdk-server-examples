module Infrastructure
  module Mappers
    module ServiceMapper
      module_function

      def to_sdk_request(request_dto)
        sdk_request = OnlinePayments::SDK::Domain::GetIINDetailsRequest.new
        sdk_request.bin = request_dto.card_number.to_s.first(6)
        sdk_request
      end

      def from_sdk_response(sdk_response)
        Business::Dtos::Service::GetPaymentProductId::ResponseDto.new(
          sdk_response.payment_product_id
        )
      end
    end
  end
end