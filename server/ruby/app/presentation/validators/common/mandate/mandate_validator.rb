require_relative 'mandate_contract'

module Presentation
  module Validators
    module Common
      module Mandate
        class MandateValidator
          def validate(mandate)
            if mandate.nil?
              raise Business::Exceptions::ValidationErrorResponse.new('The mandate object is required.')
            end

            params = normalize_to_hash(mandate)
            result = MandateContract.new.call(params)

            if result.failure?
              message = result.errors.to_h.values.flatten.first
              raise Business::Exceptions::ValidationErrorResponse.new(message)
            end

            true
          end

          private

          def normalize_to_hash(mandate)
            return mandate if mandate.is_a?(Hash)

            if mandate.respond_to?(:to_h)
              mandate.to_h.transform_keys(&:to_sym)
            else
              get_object_vars = {}
              mandate.instance_variables.each do |iv|
                key = iv.to_s.delete_prefix('@').to_sym
                get_object_vars[key] = mandate.instance_variable_get(iv)
              end
              get_object_vars
            end
          end
        end
      end
    end
  end
end
