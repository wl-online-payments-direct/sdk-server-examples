module Infrastructure
  module Mappers
    module PaymentDetails
      class AcquirerSelectionInformationMapper
        def self.from_sdk_response(response)
          return nil if response.nil?

          dto = Infrastructure::Application::Domain::Payments::PaymentDetails::AcquirerSelectionInformation.new
          dto.fallback_level = response.fallback_level
          dto.rule_name = response.rule_name
          dto.result = response.result

          dto
        end
      end
    end
  end
end