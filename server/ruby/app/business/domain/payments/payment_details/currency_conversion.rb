module Business
  module Domain
    module Payments
      module PaymentDetails
        class CurrencyConversion
          attr_accessor :accepted_by_user, :proposal

          def initialize(accepted_by_user: nil, proposal: nil)
            @accepted_by_user = accepted_by_user
            @proposal = proposal
          end

          def to_h
            {
              'acceptedByUser' => @accepted_by_user,
              'proposal' => @proposal&.to_h
            }
          end
        end
      end
    end
  end
end