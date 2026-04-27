module Business
  module Domain
    module Payments
      module PaymentDetails
        class PaymentOutput
          attr_accessor :amount_of_money, :references, :acquired_amount, :customer,
                        :card_payment_method_specific_output, :payment_method, :merchant_parameters,
                        :discount, :surcharge_specific_output, :sepa_direct_debit_payment_method_specific_output,
                        :redirect_payment_method_specific_output, :mobile_payment_method_specific_output

          def initialize(amount_of_money: nil, references: nil, acquired_amount: nil, customer: nil,
                         card_payment_method_specific_output: nil, payment_method: nil, merchant_parameters: nil,
                         discount: nil, surcharge_specific_output: nil, sepa_direct_debit_payment_method_specific_output: nil,
                         redirect_payment_method_specific_output: nil, mobile_payment_method_specific_output: nil)
            @amount_of_money = amount_of_money
            @references = references
            @acquired_amount = acquired_amount
            @customer = customer
            @card_payment_method_specific_output = card_payment_method_specific_output
            @payment_method = payment_method
            @merchant_parameters = merchant_parameters
            @discount = discount
            @surcharge_specific_output = surcharge_specific_output
            @sepa_direct_debit_payment_method_specific_output = sepa_direct_debit_payment_method_specific_output
            @redirect_payment_method_specific_output = redirect_payment_method_specific_output
            @mobile_payment_method_specific_output = mobile_payment_method_specific_output
          end

          def to_h
            {
              'amountOfMoney' => @amount_of_money&.to_h,
              'references' => @references&.to_h,
              'acquiredAmount' => @acquired_amount&.to_h,
              'customer' => @customer&.to_h,
              'cardPaymentMethodSpecificOutput' => @card_payment_method_specific_output&.to_h,
              'paymentMethod' => @payment_method,
              'merchantParameters' => @merchant_parameters,
              'discount' => @discount&.to_h,
              'surchargeSpecificOutput' => @surcharge_specific_output&.to_h,
              'sepaDirectDebitPaymentMethodSpecificOutput' => @sepa_direct_debit_payment_method_specific_output&.to_h,
              'redirectPaymentMethodSpecificOutput' => @redirect_payment_method_specific_output&.to_h,
              'mobilePaymentMethodSpecificOutput' => @mobile_payment_method_specific_output&.to_h
            }
          end
        end
      end
    end
  end
end
