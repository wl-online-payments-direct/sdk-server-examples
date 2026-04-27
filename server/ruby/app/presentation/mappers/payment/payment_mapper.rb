module Presentation
  module Mappers
    module PaymentMapper
      SMALLEST_UNIT = 100
      module_function

      def to_dto(request)
        request = request.is_a?(Hash) ? request : {}

        amount_value = request[:amount]
        amount = amount_value ? (amount_value.to_f * SMALLEST_UNIT).to_i : nil

        currency_value = request[:currency]
        currency =
          if currency_value.nil?
            nil
          elsif currency_value.respond_to?(:to_h)
            currency_value
          else
            Business::Domain::Enums::Common::Currency.try_from(currency_value)
          end

        method_value = request[:method]
        method_enum =
          if method_value.nil?
            nil
          elsif method_value.respond_to?(:to_h)
            method_value
          else
            Business::Domain::Enums::Payments::PaymentMethodType.try_from(method_value)
          end

        mandate_hash = request[:mandate]
        mandate_obj = if mandate_hash.is_a?(Hash)
                        Business::Domain::Payments::Mandate.from_sdk_hash(mandate_hash)
                      else
                        mandate_hash
                      end

        Business::Dtos::CreatePayment::RequestDto.new(
          amount: amount,
          currency: currency,
          method: method_enum,
          hosted_tokenization_id: request[:hosted_tokenization_id],
          shipping_address: build_address(request[:shipping_address]),
          billing_address: build_address(request[:billing_address]),
          card: build_card(request[:card]),
          mandate: mandate_obj
        )
      end

      def from_dto(response_dto)
        Presentation::Models::CreatePayment::Response.new(
          id: response_dto.id,
          status: response_dto.status,
          status_output: response_dto.status_output
        )
      end

      def build_card(hash)
        return nil unless hash.is_a?(Hash) && hash.any?

        Business::Domain::Payments::Card.new(
          number: hash[:number],
          holder_name: hash[:holder_name],
          verification_code: hash[:verification_code],
          expiry_month: hash[:expiry_month],
          expiry_year: hash[:expiry_year]
        )
      end

      def build_address(hash)
        return nil unless hash.is_a?(Hash) && hash.any?

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