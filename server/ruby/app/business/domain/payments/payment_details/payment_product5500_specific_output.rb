module Business
  module Domain
    module Payments
      module PaymentDetails
        class PaymentProduct5500SpecificOutput
          attr_accessor :entity_id, :payment_end_date, :payment_reference, :payment_start_date

          def initialize(payment_reference: nil, payment_end_date: nil, payment_start_date: nil, entity_id: nil)
            @payment_reference = payment_reference
            @payment_end_date = payment_end_date
            @payment_start_date = payment_start_date
            @entity_id = entity_id
          end

          def to_h
            {
              'entityId' => @entity_id,
              'paymentEndDate' => @payment_end_date,
              'paymentReference' => @payment_reference,
              'paymentStartDate' => @payment_start_date
            }
          end
        end
      end
    end
  end
end