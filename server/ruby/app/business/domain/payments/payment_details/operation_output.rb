module Business
  module Domain
    module Payments
      module PaymentDetails
        class OperationOutput
          attr_accessor :amount_of_money, :id, :operation_references, :payment_method,
                        :references, :status, :status_output

          def initialize(amount_of_money: nil, id: nil, operation_references: nil,
                         payment_method: nil, references: nil, status: nil, status_output: nil)
            @amount_of_money = amount_of_money
            @id = id
            @operation_references = operation_references
            @payment_method = payment_method
            @references = references
            @status = status
            @status_output = status_output
          end

          def to_h
            {
              'amountOfMoney' => @amount_of_money&.to_h,
              'id' => @id,
              'operation_references' => @operation_references&.to_h,
              'payment_method' => @payment_method,
              'references' => @references&.to_h,
              'status' => @status,
              'status_output' => @status_output&.to_h
            }
          end
        end
      end
    end
  end
end