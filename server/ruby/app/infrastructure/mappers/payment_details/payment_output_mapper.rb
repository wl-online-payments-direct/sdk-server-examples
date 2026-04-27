module Infrastructure
  module Mappers
    module PaymentDetails
      class PaymentOutputMapper
        def self.from_sdk_response(response)
          return nil if response.nil?

          dto = Business::Domain::Payments::PaymentDetails::PaymentOutput.new
          dto.discount = Infrastructure::Mappers::PaymentDetails::DiscountMapper.from_sdk_response(response.discount)
          dto.amount_of_money = Infrastructure::Mappers::PaymentDetails::AmountOfMoneyMapper.from_sdk_response(response.amount_of_money)
          dto.customer = Infrastructure::Mappers::PaymentDetails::CustomerOutputMapper.from_sdk_response(response.customer)
          dto.payment_method = response.payment_method
          dto.merchant_parameters = response.merchant_parameters
          dto.acquired_amount = Infrastructure::Mappers::PaymentDetails::AmountOfMoneyMapper.from_sdk_response(response.acquired_amount)
          dto.references = Infrastructure::Mappers::PaymentDetails::PaymentReferencesMapper.from_sdk_response(response.references)
          dto.surcharge_specific_output = Infrastructure::Mappers::PaymentDetails::SurchargeSpecificOutputMapper.from_sdk_response(response.surcharge_specific_output)
          dto.card_payment_method_specific_output = Infrastructure::Mappers::PaymentDetails::CardPaymentMethodSpecificOutputMapper.from_sdk_response(response.card_payment_method_specific_output)
          dto.mobile_payment_method_specific_output = Infrastructure::Mappers::PaymentDetails::MobilePaymentMethodSpecificOutputMapper.from_sdk_response(response.mobile_payment_method_specific_output)
          dto.redirect_payment_method_specific_output = Infrastructure::Mappers::PaymentDetails::RedirectPaymentMethodSpecificOutputMapper.from_sdk_response(response.redirect_payment_method_specific_output)
          dto.sepa_direct_debit_payment_method_specific_output = Infrastructure::Mappers::PaymentDetails::SepaDirectDebitPaymentMethodSpecificOutputMapper.from_sdk_response(response.sepa_direct_debit_payment_method_specific_output)

          dto
        end
      end
    end
  end
end
