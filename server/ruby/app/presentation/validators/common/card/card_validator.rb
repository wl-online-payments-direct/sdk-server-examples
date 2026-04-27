module Presentation
  module Validators
    module Common
      module Card
        class CardValidator
          def validate(card)
            if card.nil?
              raise Business::Exceptions::ValidationErrorResponse.new('The card object is required.')
            end

            params = normalize_to_hash(card)
            result = contract.call(params)

            if result.failure?
              message = result.errors.to_h.values.flatten.first
              raise Business::Exceptions::ValidationErrorResponse.new(message)
            end

            []
          end

          private

          def contract
            @contract ||= CardContract.new(prefix: 'Card')
          end

          def normalize_to_hash(card)
            hash = card.is_a?(Hash) ? card : card.to_h
            hash.transform_keys(&:to_sym)
          end
        end
      end
    end
  end
end