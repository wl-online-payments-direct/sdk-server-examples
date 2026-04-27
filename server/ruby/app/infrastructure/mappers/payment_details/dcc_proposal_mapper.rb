module Infrastructure
  module Mappers
    module PaymentDetails
      class DccProposalMapper
        def self.from_sdk_response(response)
          return nil if response.nil?

          dto = Business::Domain::Payments::PaymentDetails::DccProposal.new
          dto.rate = Infrastructure::Mappers::PaymentDetails::RateDetailsMapper.from_sdk_response(response.rate)
          dto.base_amount = Infrastructure::Mappers::PaymentDetails::AmountOfMoneyMapper.from_sdk_response(response.base_amount)
          dto.disclaimer_display = response.disclaimer_display
          dto.disclaimer_receipt = response.disclaimer_receipt
          dto.target_amount = Infrastructure::Mappers::PaymentDetails::AmountOfMoneyMapper.from_sdk_response(response.target_amount)

          dto
        end
      end
    end
  end
end