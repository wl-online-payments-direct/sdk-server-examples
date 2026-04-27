module Business
  module Domain
    module Payments
      module PaymentDetails
        class PaymentProduct3208SpecificOutput
          attr_accessor :buyer_compliant_bank_message

          def initialize(buyer_compliant_bank_message: nil)
            @buyer_compliant_bank_message = buyer_compliant_bank_message
          end

          def to_h
            {
              'buyerCompliantBankMessage' => @buyer_compliant_bank_message
            }
          end
        end
      end
    end
  end
end