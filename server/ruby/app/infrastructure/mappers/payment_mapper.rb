module Infrastructure
  module Mappers
    module PaymentMapper
      module_function

      CREDIT_CARD_PRODUCT_ID = 1
      DIRECT_DEBIT_PRODUCT_ID = 771

      def to_sdk_request(dto)
        payment_request = OnlinePayments::SDK::Domain::CreatePaymentRequest.new

        order = OnlinePayments::SDK::Domain::Order.new

        amount = OnlinePayments::SDK::Domain::AmountOfMoney.new
        amount.amount = dto.amount unless dto.amount.nil?
        amount.currency_code = dto.currency&.to_s
        order.amount_of_money = amount

        customer = OnlinePayments::SDK::Domain::Customer.new
        personal_information = OnlinePayments::SDK::Domain::PersonalInformation.new
        name = OnlinePayments::SDK::Domain::PersonalName.new
        name.first_name = dto.billing_address&.first_name
        name.surname    = dto.billing_address&.last_name
        personal_information.name = name
        customer.personal_information = personal_information

        billing_address = OnlinePayments::SDK::Domain::Address.new
        billing_address.city = dto.billing_address&.city
        if dto.billing_address&.country
          billing_address.country_code = Business::Extensions::Models::CountryExtension.to_iso_alpha2(dto.billing_address.country)
        end
        billing_address.street = dto.billing_address&.street
        billing_address.zip    = dto.billing_address&.zip
        customer.billing_address = billing_address

        order.customer = customer

        if dto.shipping_address
          shipping = OnlinePayments::SDK::Domain::Shipping.new
          shipping_address = OnlinePayments::SDK::Domain::Address.new
          shipping_address.city = dto.shipping_address.city
          if dto.shipping_address&.country
            shipping_address.country_code = Business::Extensions::Models::CountryExtension.to_iso_alpha2(dto.shipping_address.country)
          end
          shipping_address.street = dto.shipping_address.street
          shipping_address.zip    = dto.shipping_address.zip
          shipping.address = shipping_address
          order.shipping = shipping
        end

        payment_request.order = order

        method_value = dto.method&.to_s

        case method_value
        when 'CREDIT_CARD'
          card_payment_method_specific_input = OnlinePayments::SDK::Domain::CardPaymentMethodSpecificInput.new
          card_payment_method_specific_input.payment_product_id = dto.payment_product_id

          card = OnlinePayments::SDK::Domain::Card.new
          card.card_number     = dto.card&.number
          card.cardholder_name = dto.card&.holder_name
          card.expiry_date     = "#{dto.card&.expiry_month}#{dto.card&.expiry_year.to_s[-2, 2]}"
          card.cvv             = dto.card&.verification_code

          card_payment_method_specific_input.card = card

          three_ds = OnlinePayments::SDK::Domain::ThreeDSecure.new
          three_ds.skip_authentication = true
          card_payment_method_specific_input.three_d_secure = three_ds

          payment_request.card_payment_method_specific_input = card_payment_method_specific_input

        when 'TOKEN'
          payment_request.hosted_tokenization_id = dto.hosted_tokenization_id

          card_payment_method_specific_input = OnlinePayments::SDK::Domain::CardPaymentMethodSpecificInput.new
          three_ds = OnlinePayments::SDK::Domain::ThreeDSecure.new
          three_ds.skip_authentication = true
          card_payment_method_specific_input.three_d_secure = three_ds
          payment_request.card_payment_method_specific_input = card_payment_method_specific_input

        when 'DIRECT_DEBIT'
          sepa_direct_debit_payment_method_specific_input = OnlinePayments::SDK::Domain::SepaDirectDebitPaymentMethodSpecificInput.new
          sepa_direct_debit_payment_method_specific_input.payment_product_id = dto.payment_product_id || DIRECT_DEBIT_PRODUCT_ID

          sepa_direct_debit_payment_product_771_specific_input = OnlinePayments::SDK::Domain::SepaDirectDebitPaymentProduct771SpecificInput.new
          sepa_direct_debit_payment_product_771_specific_input.existing_unique_mandate_reference = dto.mandate&.mandate_reference

          sepa_direct_debit_payment_method_specific_input.payment_product771_specific_input = sepa_direct_debit_payment_product_771_specific_input
          payment_request.sepa_direct_debit_payment_method_specific_input = sepa_direct_debit_payment_method_specific_input
        end

        payment_request
      end

      def from_sdk_response(response)
        response = fetch(response, 'payment')

        status_string = fetch(response, 'status')
        status = status_string&.to_s&.upcase

        status_output_obj = fetch(response, 'status_output')

        if status_output_obj
          status_code = fetch(status_output_obj, 'status_code')
          status_category_string = fetch(status_output_obj, 'status_category')
          status_category = status_category_string&.to_s&.upcase

          status_output = Business::Domain::Payments::StatusOutput.new(
            status_code: status_code,
            status_category: status_category
          )
        else
          status_output = Business::Domain::Payments::StatusOutput.new(status_code: nil, status_category: nil)
        end

        id = fetch(response, 'id')

        Business::Dtos::CreatePayment::ResponseDto.new(
          id: id,
          status: status,
          status_output: status_output
        )
      end

      def fetch(obj, key)
        return nil if obj.nil?

        return obj.send(key) if obj.respond_to?(key)

        if obj.respond_to?(:[])
          return obj[key] if obj.key?(key)
          return obj[key.to_s] if obj.key?(key.to_s)
          return obj[key.to_sym] if obj.key?(key.to_sym)
        end

        nil
      rescue StandardError
        nil
      end
    end
  end
end