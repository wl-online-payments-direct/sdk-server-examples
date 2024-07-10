require 'onlinepayments/sdk'
include OnlinePayments::SDK

class MerchantClientConfig
  def self.merchantClient
    communicatorConfiguration = CommunicatorConfiguration.new
    communicatorConfiguration.api_endpoint = 'https://' + Rails.configuration.host
    communicatorConfiguration.api_key_id = Rails.configuration.apiKey
    communicatorConfiguration.secret_api_key = Rails.configuration.apiSecret
    communicatorConfiguration.authorization_type = 'v1HMAC'

    client = Factory.create_client_from_configuration(communicatorConfiguration)

    client.merchant(Rails.configuration.merchantId)
  end
end
