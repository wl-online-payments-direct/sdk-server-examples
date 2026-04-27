module Presentation
  module Models
    module AdditionalPaymentActions
      class Response
        attr_accessor :id, :status, :status_output

        def initialize(id: nil, status: nil, status_output: nil)
          @id = id
          @status = status
          @status_output = status_output
        end

        def to_h
          {
            id: id,
            status: status&.to_s,
            statusOutput: status_output ? {
              statusCode: status_output.status_code,
              statusCategory: status_output.status_category
            } : nil
          }
        end
      end
    end
  end
end
