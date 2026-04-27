module Business
  module Dtos
    module AdditionalPaymentActions
      class ResponseDto
        attr_accessor :id, :status, :status_output

        def initialize(id: nil, status: nil, status_output: nil)
          @id = id
          @status = status
          @status_output = status_output
        end
      end
    end
  end
end