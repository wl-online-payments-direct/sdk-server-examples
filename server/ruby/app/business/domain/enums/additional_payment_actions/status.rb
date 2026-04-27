module Business
  module Domain
    module Enums
      module AdditionalPaymentActions
        module Status
          CREATED                 = :CREATED
          CANCELLED               = :CANCELLED
          REJECTED                = :REJECTED
          REJECTED_CAPTURE        = :REJECTED_CAPTURE
          REDIRECTED              = :REDIRECTED
          PENDING_PAYMENT         = :PENDING_PAYMENT
          PENDING_COMPLETION      = :PENDING_COMPLETION
          PENDING_CAPTURE         = :PENDING_CAPTURE
          AUTHORIZATION_REQUESTED = :AUTHORIZATION_REQUESTED
          CAPTURE_REQUESTED       = :CAPTURE_REQUESTED
          CAPTURED                = :CAPTURED
          REVERSED                = :REVERSED
          REFUND_REQUESTED        = :REFUND_REQUESTED
          REFUNDED                = :REFUNDED

          ALL = [
            CREATED,
            CANCELLED,
            REJECTED,
            REJECTED_CAPTURE,
            REDIRECTED,
            PENDING_PAYMENT,
            PENDING_COMPLETION,
            PENDING_CAPTURE,
            AUTHORIZATION_REQUESTED,
            CAPTURE_REQUESTED,
            CAPTURED,
            REVERSED,
            REFUND_REQUESTED,
            REFUNDED
          ].freeze

          module_function

          def try_from(value)
            return nil if value.nil?
            value = value.to_sym if value.is_a?(String)
            ALL.find { |v| v == value }
          end
        end
      end
    end
  end
end
