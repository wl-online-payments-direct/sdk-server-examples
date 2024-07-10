class HostedTokenizationService
  def self.init_hosted_tokenization()
    merchant_client = MerchantClientConfig.merchantClient()

    hosted_tokenization_client = merchant_client.hosted_tokenization()

    return hosted_tokenization_client.create_hosted_tokenization(CreateHostedTokenizationRequest.new)
  end
end
