module Business
  module Domain
    module Payments
      module PaymentDetails
        class PaymentProduct840SpecificOutput
          attr_accessor :billing_address, :customer_account, :customer_address, :protection_eligibility

          def initialize(billing_address: nil, customer_account: nil, customer_address: nil, protection_eligibility: nil)
            @billing_address = billing_address
            @customer_account = customer_account
            @customer_address = customer_address
            @protection_eligibility = protection_eligibility
          end

          def to_h
            {
              'billingAddress' => @billing_address&.to_h,
              'customerAccount' => @customer_account&.to_h,
              'customerAddress' => @customer_address&.to_h,
              'protectionEligibility' => @protection_eligibility&.to_h
            }
          end
        end
      end
    end
  end
end