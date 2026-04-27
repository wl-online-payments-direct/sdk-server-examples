module Presentation
  module Mappers
    module HostedCheckout
      module HostedCheckoutMapper
        SMALLEST_UNIT = 100

        module_function

        def to_dto(params)
          Business::Dtos::CreateHostedCheckout::RequestDto.new(
            amount: (params[:amount].to_f * SMALLEST_UNIT).to_i,
            currency: params[:currency],
            language: params[:language],
            redirect_url: params[:redirect_url],
            billing_address: build_address(params[:billing_address]),
            shipping_address: build_address(params[:shipping_address])
          )
        end

        def from_dto(dto)
          Presentation::Models::CreateHostedCheckout::Response.new(
            hosted_checkout_id: dto.hosted_checkout_id,
            redirect_url: dto.redirect_url,
            return_mac: dto.return_mac,
            amount: dto.amount,
            currency: dto.currency
          )
        end

        def from_get_payment_dto(dto)
          return nil if dto.nil?

          Presentation::Models::GetPaymentByHostedCheckoutId::Response.new(
            status: dto.status,
            payment_id: dto.payment_id
          )
        end

        def build_address(hash)
          return nil unless hash&.any?

          Business::Dtos::Common::Address.new(
            first_name: hash[:first_name],
            last_name: hash[:last_name],
            street: hash[:street],
            city: hash[:city],
            zip: hash[:zip],
            country: hash[:country]
          )
        end
      end
    end
  end
end