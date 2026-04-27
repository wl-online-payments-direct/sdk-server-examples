module Business
  module Services
    module HostedCheckout
      class HostedCheckoutService
        def initialize(hosted_checkout_client:)
          @hosted_checkout_client = hosted_checkout_client
        end

        def create_hosted_checkout(request_dto)
          response_dto = @hosted_checkout_client.create_hosted_checkout(request_dto)

          response_dto.amount = request_dto.amount
          response_dto.currency = request_dto.currency

          response_dto
        end

        def get_payment_by_hosted_checkout_id(id)
          @hosted_checkout_client.get_payment_by_hosted_checkout_id(id)
        end
      end
    end
  end
end