class CreateHostedCheckoutBasicDto
  attr_accessor :amount, :currency, :redirect_url

  def initialize(amount, currency, redirect_url)
    @amount = amount
    @currency = currency
    @redirect_url = redirect_url
  end

  def to_h
    {
      amount: @amount,
      currency: @currency,
      redirectUrl: @redirect_url
    }
  end
end
