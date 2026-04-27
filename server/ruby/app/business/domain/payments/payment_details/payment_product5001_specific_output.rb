module Business
  module Domain
    module Payments
      module PaymentDetails
        class PaymentProduct5001SpecificOutput
          attr_accessor :account_number, :authorisation_code, :liability,
                        :mobile_phone_number, :operation_code

          def initialize(liability: nil, account_number: nil, authorisation_code: nil,
                         operation_code: nil, mobile_phone_number: nil)
            @liability = liability
            @account_number = account_number
            @authorisation_code = authorisation_code
            @operation_code = operation_code
            @mobile_phone_number = mobile_phone_number
          end

          def to_h
            {
              'accountNumber' => @account_number,
              'authorisationCode' => @authorisation_code,
              'liability' => @liability,
              'mobilePhoneNumber' => @mobile_phone_number,
              'operationCode' => @operation_code
            }
          end
        end
      end
    end
  end
end