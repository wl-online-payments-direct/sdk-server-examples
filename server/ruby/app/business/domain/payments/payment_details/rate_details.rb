module Business
  module Domain
    module Payments
      module PaymentDetails
        class RateDetails
          attr_accessor :exchange_rate, :inverted_exchange_rate, :mark_up_rate,
                        :quotation_date_time, :source

          def initialize(exchange_rate: nil, inverted_exchange_rate: nil, mark_up_rate: nil,
                         quotation_date_time: nil, source: nil)
            @exchange_rate = exchange_rate
            @inverted_exchange_rate = inverted_exchange_rate
            @mark_up_rate = mark_up_rate
            @quotation_date_time = quotation_date_time
            @source = source
          end

          def to_h
            {
              'exchangeRate' => @exchange_rate,
              'invertedExchangeRate' => @inverted_exchange_rate,
              'markUpRate' => @mark_up_rate,
              'quotationDateTime' => @quotation_date_time,
              'source' => @source
            }
          end
        end
      end
    end
  end
end