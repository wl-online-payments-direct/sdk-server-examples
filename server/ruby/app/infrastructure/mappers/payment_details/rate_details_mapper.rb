module Infrastructure
  module Mappers
    module PaymentDetails
      class RateDetailsMapper
        def self.from_sdk_response(response)
          return nil if response.nil?

          Business::Domain::Payments::PaymentDetails::RateDetails.new(
            source: response.source,
            exchange_rate: response.exchange_rate,
            inverted_exchange_rate: response.inverted_exchange_rate,
            mark_up_rate: response.mark_up_rate,
            quotation_date_time: response.quotation_date_time
          )
        end
      end
    end
  end
end