module Infrastructure
  module Mappers
    module HostedCheckoutMapper
      module_function

      def to_sdk_request(dto)
        sdk_request = OnlinePayments::SDK::Domain::CreateHostedCheckoutRequest.new

        order = OnlinePayments::SDK::Domain::Order.new

        amount = OnlinePayments::SDK::Domain::AmountOfMoney.new
        amount.amount = dto.amount
        amount.currency_code = dto.currency
        order.amount_of_money = amount

        customer = OnlinePayments::SDK::Domain::Customer.new

        if dto.billing_address
          personal = OnlinePayments::SDK::Domain::PersonalInformation.new
          name = OnlinePayments::SDK::Domain::PersonalName.new
          name.first_name = dto.billing_address&.first_name
          name.surname = dto.billing_address&.last_name
          personal.name = name
          customer.personal_information = personal

          billing = OnlinePayments::SDK::Domain::Address.new
          billing.city = dto.billing_address&.city
          billing.country_code = Business::Extensions::Models::CountryExtension.to_iso_alpha2(dto.billing_address&.country)
          billing.street = dto.billing_address&.street
          billing.zip = dto.billing_address&.zip
          customer.billing_address = billing
        end

        order.customer = customer

        if dto.shipping_address
          shipping = OnlinePayments::SDK::Domain::Shipping.new
          shipping_address = OnlinePayments::SDK::Domain::AddressPersonal.new
          shipping_address.city = dto.shipping_address&.city
          shipping_address.country_code = Business::Extensions::Models::CountryExtension.to_iso_alpha2(dto.shipping_address&.country)
          shipping_address.street = dto.shipping_address&.street
          shipping_address.zip = dto.shipping_address&.zip

          shipping_name = OnlinePayments::SDK::Domain::PersonalName.new
          shipping_name.first_name = dto.shipping_address&.first_name
          shipping_name.surname = dto.shipping_address&.last_name
          shipping_address.name = shipping_name

          shipping.address = shipping_address
          order.shipping = shipping
        end

        hosted_checkout_input = OnlinePayments::SDK::Domain::HostedCheckoutSpecificInput.new
        hosted_checkout_input.return_url = dto.redirect_url
        hosted_checkout_input.locale = Business::Extensions::Models::LanguageExtension.to_locale(dto.language, dto.billing_address&.country)

        sdk_request.order = order
        sdk_request.hosted_checkout_specific_input = hosted_checkout_input

        sdk_request
      end

      def from_sdk_create_response(response)
        Business::Dtos::CreateHostedCheckout::ResponseDto.new(
          hosted_checkout_id: response.hosted_checkout_id,
          redirect_url: response.redirect_url,
          return_mac: response.returnmac
        )
      end

      def from_sdk_get_response(response)
        dto = Business::Dtos::GetPaymentByHostedCheckoutId::ResponseDto.new
        dto.status = response&.status
        dto.payment_id = response&.created_payment_output&.payment&.id
        dto
      end
    end
  end
end