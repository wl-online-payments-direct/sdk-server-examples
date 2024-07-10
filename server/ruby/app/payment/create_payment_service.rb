class CreatePaymentService
  def self.create_payment(create_payment_request)
    merchant_client = MerchantClientConfig.merchantClient()

    payments_client = merchant_client.payments()

    return payments_client.create_payment(create_payment_request)
  end
end
