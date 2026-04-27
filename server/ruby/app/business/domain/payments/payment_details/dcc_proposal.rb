module Business
  module Domain
    module Payments
      module PaymentDetails
        class DccProposal
          attr_accessor :base_amount, :disclaimer_display, :disclaimer_receipt, :rate, :target_amount

          def initialize(base_amount: nil, disclaimer_display: nil, disclaimer_receipt: nil, rate: nil, target_amount: nil)
            @base_amount = base_amount
            @disclaimer_display = disclaimer_display
            @disclaimer_receipt = disclaimer_receipt
            @rate = rate
            @target_amount = target_amount
          end

          def to_h
            {
              'baseAmount' => @base_amount&.to_h,
              'disclaimerDisplay' => @disclaimer_display,
              'disclaimerReceipt' => @disclaimer_receipt,
              'rate' => @rate&.to_h,
              'targetAmount' => @target_amount&.to_h
            }
          end
        end
      end
    end
  end
end
