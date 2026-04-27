module Business
  module Dtos
    module GetPaymentDetails
      class ResponseDto
        attr_accessor :operations
        attr_accessor :hosted_checkout_specific_output
        attr_accessor :payment_output
        attr_accessor :status
        attr_accessor :status_output
        attr_accessor :id
        def initialize(
          operations: nil,
          hosted_checkout_specific_output: nil,
          payment_output: nil,
          status: nil,
          status_output: nil,
          id: nil
        )
          @operations = operations
          @hosted_checkout_specific_output = hosted_checkout_specific_output
          @payment_output = payment_output
          @status = status
          @status_output = status_output
          @id = id
        end
      end
    end
  end
end