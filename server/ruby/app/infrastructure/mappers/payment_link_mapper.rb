module Infrastructure
  module Mappers
    module PaymentLinkMapper
      module_function

      def to_sdk_request(dto)
        create_payment_link_request = OnlinePayments::SDK::Domain::CreatePaymentLinkRequest.new

        order = OnlinePayments::SDK::Domain::Order.new

        amount_of_money = OnlinePayments::SDK::Domain::AmountOfMoney.new
        amount_of_money.currency_code = dto.currency&.to_s
        amount_of_money.amount = dto.amount
        order.amount_of_money = amount_of_money

        references = OnlinePayments::SDK::Domain::OrderReferences.new
        references.merchant_reference = SecureRandom.hex(16)
        order.references = references

        create_payment_link_request.order = order

        payment_link_specific_input = OnlinePayments::SDK::Domain::PaymentLinkSpecificInput.new
        payment_link_specific_input.description = dto.description if dto.description

        if dto.valid_for
          payment_link_specific_input.expiration_date = DateTime.now.new_offset(0) + Rational(dto.valid_for.to_i, 24)
        end

        create_payment_link_request.payment_link_specific_input = payment_link_specific_input

        create_payment_link_request
      end
      def from_sdk_response(response)
        order = response.payment_link_order

        Business::Dtos::PaymentLink::ResponseDto.new(
          payment_link_id: response.payment_link_id,
          redirect_url: response.redirection_url,
          status: response.status,
          amount: order&.amount&.amount,
          currency: order&.amount&.currency_code
        )
      end
    end
  end
end