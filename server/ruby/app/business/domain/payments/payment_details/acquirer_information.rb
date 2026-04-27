module Business
  module Domain
    module Payments
      module PaymentDetails
        class AcquirerInformation
          attr_accessor :acquirer_selection_information, :name

          def initialize(acquirer_selection_information: nil, name: nil)
            @acquirer_selection_information = acquirer_selection_information
            @name = name
          end

          def to_h
            {
              acquirerSelectionInformation: @acquirer_selection_information&.to_h,
              name: @name
            }
          end
        end
      end
    end
  end
end