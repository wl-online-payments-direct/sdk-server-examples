module Business
  module Domain
    module Payments
      module PaymentDetails
        class PaymentProduct840CustomerAccount
          attr_accessor :account_id, :company_name, :country_code, :customer_account_status,
                        :customer_address_status, :first_name, :payer_id, :surname

          def initialize(account_id: nil, company_name: nil, country_code: nil,
                         customer_account_status: nil, customer_address_status: nil,
                         first_name: nil, payer_id: nil, surname: nil)
            @account_id = account_id
            @company_name = company_name
            @country_code = country_code
            @customer_account_status = customer_account_status
            @customer_address_status = customer_address_status
            @first_name = first_name
            @payer_id = payer_id
            @surname = surname
          end

          def to_h
            {
              'accountId' => @account_id,
              'companyName' => @company_name,
              'countryCode' => @country_code,
              'customerAccountStatus' => @customer_account_status,
              'customerAddressStatus' => @customer_address_status,
              'firstName' => @first_name,
              'payerId' => @payer_id,
              'surname' => @surname
            }
          end
        end
      end
    end
  end
end
