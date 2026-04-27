module Business
  module Domain
    module Payments
      module PaymentDetails
        class PaymentStatusOutput
          attr_accessor :errors, :is_authorized, :is_cancellable, :is_refundable,
                        :status_category, :status_code, :status_code_change_date_time

          def initialize(errors: nil, is_authorized: nil, is_cancellable: nil, is_refundable: nil,
                         status_category: nil, status_code: nil, status_code_change_date_time: nil)
            @errors = errors
            @is_authorized = is_authorized
            @is_cancellable = is_cancellable
            @is_refundable = is_refundable
            @status_category = status_category
            @status_code = status_code
            @status_code_change_date_time = status_code_change_date_time
          end

          def to_h
            {
              'errors' => @errors&.map(&:to_h),
              'isAuthorized' => @is_authorized,
              'isCancellable' => @is_cancellable,
              'isRefundable' => @is_refundable,
              'statusCategory' => @status_category,
              'statusCode' => @status_code,
              'statusCodeChangeDateTime' => @status_code_change_date_time
            }
          end
        end
      end
    end
  end
end