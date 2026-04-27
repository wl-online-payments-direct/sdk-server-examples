module Business
  module Dtos
    module Mandate
      class GetMandateResponseDto
        attr_accessor :unique_mandate_reference

        def initialize(unique_mandate_reference)
          @unique_mandate_reference = unique_mandate_reference
        end
      end
    end
  end
end


