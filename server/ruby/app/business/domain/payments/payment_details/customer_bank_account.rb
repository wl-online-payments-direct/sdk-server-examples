module Business
  module Domain
    module Payments
      module PaymentDetails
        class CustomerBankAccount
          attr_accessor :account_holder_name, :bic, :iban

          def initialize(account_holder_name: nil, bic: nil, iban: nil)
            @account_holder_name = account_holder_name
            @bic = bic
            @iban = iban
          end

          def to_h
            {
              'accountHolderName' => @account_holder_name,
              'bic' => @bic,
              'iban' => @iban
            }
          end
        end
      end
    end
  end
end
