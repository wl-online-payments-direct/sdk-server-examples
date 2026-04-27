module Presentation
  module Validators
    module Common
      module Address
        class AddressValidator
          def validate(address_hash, prefix)
            address_hash = normalize_to_hash(address_hash)
            contract = AddressContract.new(prefix: prefix)
            result = contract.call(address_hash)

            if result.failure?
              message = result.errors.map(&:text).first
              raise Business::Exceptions::ValidationErrorResponse.new(message)
            end

            []
          end

          private

          def normalize_to_hash(address)
            address.is_a?(Hash) ? address : address.to_h
          end
        end
      end
    end
  end
end