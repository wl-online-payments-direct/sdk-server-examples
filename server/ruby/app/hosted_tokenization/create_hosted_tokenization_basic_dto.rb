class CreateHostedTokenizationBasicDto
  attr_accessor :amount, :currency, :hosted_tokenization_id

  def initialize(amount, currency, hosted_tokenization_id)
    @amount = amount
    @currency = currency
    @hosted_tokenization_id = hosted_tokenization_id
  end

  def to_h
    {
      amount: @amount,
      currency: @currency,
      hostedTokenizationId: @hosted_tokenization_id
    }
  end
end
