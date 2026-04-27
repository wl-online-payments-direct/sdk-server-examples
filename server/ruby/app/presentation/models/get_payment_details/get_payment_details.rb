module Presentation
  module Models
    module GetPaymentDetails
      class Response
        attr_accessor :operations,
                      :hosted_checkout_specific_output,
                      :payment_output,
                      :status,
                      :status_output,
                      :id

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

        def to_h
          {
            'operations' => (@operations || []).map { |op| op.to_h },
            'hostedCheckoutSpecificOutput' => (@hosted_checkout_specific_output || Business::Domain::Payments::PaymentDetails::HostedCheckoutSpecificOutput.new).to_h,
            'paymentOutput' => (@payment_output || Business::Domain::Payments::PaymentDetails::PaymentOutput.new).to_h,
            'status' => @status,
            'statusOutput' => (@status_output || Business::Domain::Payments::PaymentDetails::PaymentStatusOutput.new).to_h,
            'id' => @id
          }
        end
      end
    end
  end
end