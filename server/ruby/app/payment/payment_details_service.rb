class PaymentDetailsService
  def self.get_payment_details_for_hosted_checkout(hosted_checkout_id)
    merchant_client = MerchantClientConfig.merchantClient()

    payments_client = merchant_client.payments()
    payment_id = "#{hosted_checkout_id}_0"

    return payments_client.get_payment_details(payment_id)
  end

  def self.get_payment_details(payment_id)
    merchant_client = MerchantClientConfig.merchantClient()

    payments_client = merchant_client.payments()

    return payments_client.get_payment_details(payment_id)
  end
end
