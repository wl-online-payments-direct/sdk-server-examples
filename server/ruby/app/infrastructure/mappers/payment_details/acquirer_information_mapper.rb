module Infrastructure
  module Mappers
    module PaymentDetails
      class AcquirerInformationMapper
        def self.from_sdk_response(response)
          return nil if response.nil?

          dto = Business::Domain::Payments::PaymentDetails::AcquirerInformation.new
          dto.acquirer_selection_information = Infrastructure::Mappers::PaymentDetails::AcquirerSelectionInformationMapper.from_sdk_response(response.acquirer_selection_information)
          dto.name = response.name

          dto
        end
      end
    end
  end
end