module Infrastructure
  module Mappers
    module PaymentDetails
      class CurrencyConversionMapper
        def self.from_sdk_response(response)
          return nil if response.nil?

          dto = Business::Domain::Payments::PaymentDetails::CurrencyConversion.new
          dto.accepted_by_user = response.accepted_by_user
          dto.proposal = Infrastructure::Mappers::PaymentDetails::DccProposalMapper.from_sdk_response(response.proposal)

          dto
        end
      end
    end
  end
end