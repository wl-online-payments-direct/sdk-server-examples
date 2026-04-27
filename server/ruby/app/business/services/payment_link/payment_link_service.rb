module Business
  module Services
    module PaymentLink
      class PaymentLinkService
        attr_reader :payment_link_client

        def initialize(payment_link_client:)
          @payment_link_client = payment_link_client
        end

        def create_payment_link(request_dto)
          response_dto = payment_link_client.create_payment_link(request_dto)

          response_dto.amount   = request_dto.amount
          response_dto.currency = request_dto.currency

          response_dto
        end
      end
    end
  end
end