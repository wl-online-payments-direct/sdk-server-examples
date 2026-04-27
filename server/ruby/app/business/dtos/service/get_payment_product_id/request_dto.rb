module Business
  module Dtos
    module Service
      module GetPaymentProductId
        class RequestDto
          attr_accessor :card_number

          def initialize(card_number = nil)
            @card_number = card_number
          end
        end
      end
    end
  end
end
