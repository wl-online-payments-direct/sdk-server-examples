require 'dotenv'
require 'onlinepayments/sdk'

module Configuration
  module MerchantClientConfiguration
    class MissingCredentialsError < StandardError; end

    class MerchantClientConfiguration
      attr_reader :merchant_id, :api_key, :api_secret, :configuration_file
      attr_reader :client, :merchant_client
      def initialize(rootpath = Dir.pwd)

        @configuration_file = ENV['CONFIG_FILE'] || File.join(rootpath, 'config', 'wl_config.yml')
        @merchant_id        = ENV['MERCHANT_ID']&.strip
        @api_key            = ENV['API_KEY']&.strip
        @api_secret         = ENV['API_SECRET']&.strip

        if [@merchant_id, @api_key, @api_secret].any?(&:nil?) || [@merchant_id, @api_key, @api_secret].any?(&:empty?)
          raise MissingCredentialsError, 'Missing required credentials: MERCHANT_ID, API_KEY, or API_SECRET'
        end

        unless File.exist?(@configuration_file)
          raise MissingCredentialsError, "Missing config file at #{@configuration_file}"
        end

        create_client_from_file
        create_merchant_client
      end

      private

      def create_client_from_file
        @client = ::OnlinePayments::SDK::Factory.create_client_from_file(
          @configuration_file,
          @api_key,
          @api_secret
        )
      rescue Errno::ENOENT
        raise MissingCredentialsError, "Configuration file not found: #{@configuration_file}"
      end

      def create_merchant_client
        @merchant_client = @client.merchant(@merchant_id)
      end
    end
  end
end