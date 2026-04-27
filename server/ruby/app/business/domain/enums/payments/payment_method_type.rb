module Business
  module Domain
    module Enums
      module Payments
        module PaymentMethodType
          TOKEN        = :TOKEN
          CREDIT_CARD  = :CREDIT_CARD
          DIRECT_DEBIT = :DIRECT_DEBIT

          ALL = [TOKEN, CREDIT_CARD, DIRECT_DEBIT].freeze

          module_function

          def try_from(value)
            return nil if value.nil?
            value = value.to_sym if value.is_a?(String)
            ALL.find { |v| v == value }
          end
        end
      end
    end
  end
end
