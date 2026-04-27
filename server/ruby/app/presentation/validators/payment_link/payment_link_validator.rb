module Presentation
  module Validators
    module PaymentLink
      class PaymentLinkValidator
        def validate(request)
          params = normalize_request_to_hash(request)
          result = contract.call(params)

          if result.failure?
            message = result.errors.to_h.values.flatten.first
            raise Business::Exceptions::ValidationErrorResponse.new(message)
          end

          result.to_h
        end

        private

        def contract
          @contract ||= PaymentLinkContract.new
        end

        def normalize_request_to_hash(request)
          request.is_a?(Hash) ? request : request.to_h
        end
      end
    end
  end
end