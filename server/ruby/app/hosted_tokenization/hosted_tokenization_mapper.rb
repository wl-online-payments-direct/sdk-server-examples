require_relative '../services/payment_utils'

require 'onlinepayments/sdk'
include OnlinePayments::SDK::Domain

class HostedTokenizationMapper

  def self.to_hosted_tokenization_payment_request(create_hosted_tokenizaiton_basic_dto)
    create_payment_request = CreatePaymentRequest.new

    card_payment_method_specific_input = CardPaymentMethodSpecificInput.new
    card_payment_method_specific_input.authorization_mode = "SALE"

    order = Order.new

    amount_of_money = AmountOfMoney.new
    amount_of_money.amount = PaymentUtils.to_amount(create_hosted_tokenizaiton_basic_dto.amount)
    amount_of_money.currency_code = create_hosted_tokenizaiton_basic_dto.currency

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
    create_payment_request.hosted_tokenization_id = create_hosted_tokenizaiton_basic_dto.hosted_tokenization_id

    return create_payment_request

  end

  def to_amount(amount)
    (amount * BigDecimal.new('100')).round(0, BigDecimal::ROUND_HALF_UP).to_i
  end
end
