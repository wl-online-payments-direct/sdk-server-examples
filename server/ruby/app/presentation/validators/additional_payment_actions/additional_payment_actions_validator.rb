module Presentation
  module Validators
    module AdditionalPaymentActions
      class AdditionalPaymentActionsValidator
        def initialize
          @contract = Presentation::Validators::AdditionalPaymentActions::AdditionalPaymentActionsContract.new
        end

        def validate(request)
          result = @contract.call(
            amount: request[:amount],
            currency: request[:currency],
            is_final: request[:is_final]
          )

          return if result.success?

          raise Business::Exceptions::ValidationErrorResponse.new(result.errors.to_h.values.flatten.first.to_s)
        end
      end
    end
  end
end