module Presentation
  module Mappers
    module PaymentLink
      module PaymentLinkMapper
        SMALLEST_UNIT = 100

        module_function

        def to_dto(request)
          Business::Dtos::PaymentLink::RequestDto.new(
            amount: (request[:amount].to_f * SMALLEST_UNIT).to_i,
            currency: request[:currency],
            description: request[:description],
            valid_for: Business::Domain::Enums::PaymentLinks::ValidFor.from_raw(request[:valid_for]),
            action: request[:action]
          )
        end

        def from_dto(response)
          Presentation::Models::PaymentLink::Response.new(
            payment_link_id: response.payment_link_id,
            redirect_url: response.redirect_url,
            status: response.status,
            amount: response.amount.nil? ? nil : response.amount.to_f / SMALLEST_UNIT,
            currency: response.currency
          )
        end
      end
    end
  end
end