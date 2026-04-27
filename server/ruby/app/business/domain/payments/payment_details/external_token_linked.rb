module Business
  module Domain
    module Payments
      module PaymentDetails
        class ExternalTokenLinked
          attr_accessor :computed_token, :gts_computed_token, :generated_token

          def initialize(computed_token: nil, gts_computed_token: nil, generated_token: nil)
            @computed_token = computed_token
            @gts_computed_token = gts_computed_token
            @generated_token = generated_token
          end

          def to_h
            {
              'computedToken' => @computed_token,
              'gtsComputedToken' => @gts_computed_token,
              'generatedToken' => @generated_token
            }
          end
        end
      end
    end
  end
end
