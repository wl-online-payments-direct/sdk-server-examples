class CreatePaymentBasicDto
  attr_accessor :card_number, :card_holder, :expiry_month, :expiry_year, :cvv, :amount, :currency

  def initialize(card_number, card_holder, expiry_month, expiry_year, cvv, amount, currency)
    @card_number = card_number
    @card_holder = card_holder
    @expiry_month = expiry_month
    @expiry_year = expiry_year
    @cvv = cvv
    @amount = amount
    @currency = currency
  end

  def to_h
    {
      cardNumber: @card_number,
      cardHolder: @card_holder,
      expiryMonth: @expiry_month,
      expiryYear: @expiry_year,
      cvv: @cvv,
      amount: @amount,
      currency: @currency
    }
  end
end
