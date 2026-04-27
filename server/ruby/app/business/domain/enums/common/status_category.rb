module Business
  module Domain
    module Enums
      module Common
        module StatusCategory
          CREATED = :CREATED
          UNSUCCESSFUL = :UNSUCCESSFUL
          PENDING_PAYMENT = :PENDING_PAYMENT
          PENDING_MERCHANT = :PENDING_MERCHANT
          PENDING_CONNECT_OR_3RD_PARTY = :PENDING_CONNECT_OR_3RD_PARTY
          COMPLETED = :COMPLETED
          REVERSED = :REVERSED
          REFUNDED = :REFUNDED

          ALL = [
            CREATED,
            UNSUCCESSFUL,
            PENDING_PAYMENT,
            PENDING_MERCHANT,
            PENDING_CONNECT_OR_3RD_PARTY,
            COMPLETED,
            REVERSED,
            REFUNDED
          ].freeze

          module_function

          def try_from(value)
            return nil if value.nil?
            value = value.to_sym if value.is_a?(String)
            ALL.find { |v| v == value }
          end
        end
      end
    end
  end
end
