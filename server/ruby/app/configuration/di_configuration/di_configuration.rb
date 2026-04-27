  module Configuration
    module DiConfiguration
      class DiConfiguration
        attr_reader :merchant_config,
                    :hosted_checkout_client, :hosted_checkout_service,
                    :payment_link_client, :payment_link_service,
                    :hosted_tokenization_client, :hosted_tokenization_service,
                    :service_client

        def self.instance
          @instance ||= new(Rails.root).configure
        end

        def self.fetch(key)
          instance.fetch(key) { raise KeyError, "Unknown DI dependency: #{key}" }
        end

        def initialize(project_root = Rails.root)
          @project_root = project_root
          @merchant_config = nil

          @hosted_checkout_client = nil
          @hosted_checkout_service = nil

          @payment_link_client = nil
          @payment_link_service = nil

          @hosted_tokenization_client = nil
          @hosted_tokenization_service = nil

          @payment_client = nil
          @payment_service = nil
        end

        def configure
          @merchant_config ||= Configuration::MerchantClientConfiguration::MerchantClientConfiguration.new(@project_root)

          @hosted_checkout_client ||= Infrastructure::SdkClients::HostedCheckoutClient.new(
            merchant_client: @merchant_config.merchant_client
          )
          @hosted_checkout_service ||= Business::Services::HostedCheckout::HostedCheckoutService.new(
            hosted_checkout_client: @hosted_checkout_client
          )

          @payment_link_client ||= Infrastructure::SdkClients::PaymentLinkClient.new(
            merchant_client: @merchant_config.merchant_client
          )
          @payment_link_service ||= Business::Services::PaymentLink::PaymentLinkService.new(
            payment_link_client: @payment_link_client
          )

          @hosted_tokenization_client ||= Infrastructure::SdkClients::HostedTokenizationClient.new(
            merchant_client: @merchant_config.merchant_client
          )
          @hosted_tokenization_service ||= Business::Services::HostedTokenization::HostedTokenizationService.new(
            hosted_tokenization_client: @hosted_tokenization_client
          )

          @payment_client ||= Infrastructure::SdkClients::PaymentClient.new(
            merchant_client: @merchant_config.merchant_client
          )

          @mandate_client ||= Infrastructure::SdkClients::MandateClient.new(
            merchant_client: @merchant_config.merchant_client
          )

          @service_client ||= Infrastructure::SDKClients::ServiceClient.new(
            merchant_client: @merchant_config.merchant_client,
          )

          credit_card_handler =
            Business::Handlers::CreditCardPaymentHandler.new(
              payment_client: @payment_client,
              service_client: @service_client
            )

          direct_debit_handler =
            Business::Handlers::DirectDebitPaymentHandler.new(
              payment_client: @payment_client,
              mandate_client: @mandate_client
            )

          token_handler =
            Business::Handlers::TokenPaymentHandler.new(
              payment_client: @payment_client
            )

          @payment_service ||= Business::Services::Payment::PaymentService.new(
            payment_client: @payment_client,
            handlers: [
              credit_card_handler,
              direct_debit_handler,
              token_handler
            ]
          )

          {
            merchant_client: @merchant_config.merchant_client,
            hosted_checkout_client: @hosted_checkout_client,
            hosted_checkout_service: @hosted_checkout_service,
            payment_link_client: @payment_link_client,
            payment_link_service: @payment_link_service,
            hosted_tokenization_client: @hosted_tokenization_client,
            hosted_tokenization_service: @hosted_tokenization_service,
            payment_client: @payment_client,
            payment_service: @payment_service
          }
        end
      end
    end
  end
