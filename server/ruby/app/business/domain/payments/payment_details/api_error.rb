module Business
  module Domain
    module Payments
      module PaymentDetails
        class APIError
          attr_accessor :category, :code, :error_code, :http_status_code,
                        :id, :message, :property_name, :retriable

          def initialize(category: nil, code: nil, error_code: nil, http_status_code: nil,
                         id: nil, message: nil, property_name: nil, retriable: nil)
            @category = category
            @code = code
            @error_code = error_code
            @http_status_code = http_status_code
            @id = id
            @message = message
            @property_name = property_name
            @retriable = retriable
          end

          def to_h
            {
              'category' => @category,
              'code' => @code,
              'errorCode' => @error_code,
              'httpStatusCode' => @http_status_code,
              'id' => @id,
              'message' => @message,
              'propertyName' => @property_name,
              'retriable' => @retriable
            }
          end
        end
      end
    end
  end
end