require_relative '../services/payment_utils'

require 'onlinepayments/sdk'
include OnlinePayments::SDK::Domain

class CreatePaymentMapper
  def self.to_empty_dto
    CreatePaymentBasicDto.new(
      "4012000033330026",
      "Willie E. Coyote",
      "05",
      "29",
      "123",
      nil,
      nil
    )
  end

  def self.to_create_payment_request(create_payment_basic_dto)
    create_payment_request = CreatePaymentRequest.new

    card = Card.new
    card.card_number = create_payment_basic_dto.card_number
    card.cardholder_name = create_payment_basic_dto.card_holder
    card.expiry_date = "#{create_payment_basic_dto.expiry_month}#{create_payment_basic_dto.expiry_year}"
    card.cvv = create_payment_basic_dto.cvv

    card_payment_method_specific_input = CardPaymentMethodSpecificInput.new
    card_payment_method_specific_input.card = card
    card_payment_method_specific_input.payment_product_id = 1

    order = Order.new

    amount_of_money = AmountOfMoney.new
    amount_of_money.amount = PaymentUtils.to_amount(create_payment_basic_dto.amount)
    amount_of_money.currency_code = create_payment_basic_dto.currency

    order.amount_of_money = amount_of_money

    customer = Customer.new

    device = CustomerDevice.new
    device.accept_header = "text/html,application/xhtml+xml,application/xml;q=0.9,/;q=0.8"

    browser_data = BrowserData.new
    browser_data.color_depth = 24
    browser_data.java_enabled = false
    browser_data.screen_height = "1200"
    browser_data.screen_width = "1920"

    device.browser_data = browser_data
    device.ip_address = "123.123.123.123"
    device.locale = "en_GB"
    device.user_agent = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_4) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/12.1 Safari/605.1.15"
    device.timezone_offset_utc_minutes = "420"

    customer.device = device

    order.customer = customer

    create_payment_request.order = order
    create_payment_request.card_payment_method_specific_input = card_payment_method_specific_input

    return create_payment_request

  end
end
