require_relative '../services/payment_utils'

require 'onlinepayments/sdk'
include OnlinePayments::SDK::Domain

class HostedCheckoutMapper
  def self.to_empty_dto
    CreateHostedCheckoutBasicDto.new(nil, nil, Rails.configuration.hostedCheckout.redirectUrl)
  end

  def self.to_create_hosted_checkout_request(create_hosted_checkout_basic_dto)
    create_hosted_checkout_request = CreateHostedCheckoutRequest.new

    order = Order.new

    amount_of_money = AmountOfMoney.new
    amount_of_money.amount = PaymentUtils.to_amount(create_hosted_checkout_basic_dto.amount)
    amount_of_money.currency_code = create_hosted_checkout_basic_dto.currency

    order.amount_of_money = amount_of_money

    create_hosted_checkout_request.order = order

    hosted_checkout_specific_input = HostedCheckoutSpecificInput.new
    hosted_checkout_specific_input.return_url = create_hosted_checkout_basic_dto.redirect_url

    create_hosted_checkout_request.hosted_checkout_specific_input = hosted_checkout_specific_input

    return create_hosted_checkout_request

  end

  def to_amount(amount)
    (amount * BigDecimal.new('100')).round(0, BigDecimal::ROUND_HALF_UP).to_i
  end
end
