class HostedCheckoutService
  def self.create_hosted_checkout(create_hosted_checkout_request)
    merchant_client = MerchantClientConfig.merchantClient()

    hosted_checkout_client = merchant_client.hosted_checkout()

    return hosted_checkout_client.create_hosted_checkout(create_hosted_checkout_request)
  end
end
