module Infrastructure
  module Mappers
    module PaymentDetails
      class PaymentStatusOutputMapper
        def self.from_sdk_response(response)
          return nil if response.nil?

          dto = Business::Domain::Payments::PaymentDetails::PaymentStatusOutput.new
          dto.is_authorized = response.is_authorized
          dto.is_cancellable = response.is_cancellable
          dto.is_refundable = response.is_refundable
          dto.status_category = response.status_category
          dto.status_code = response.status_code
          dto.status_code_change_date_time = response.status_code_change_date_time
          dto.errors = map_errors(response.errors)

          dto
        end

        private_class_method def self.map_errors(errors)
          return nil if errors.nil?

          errors.map { |error| Infrastructure::Mappers::PaymentDetails::ApiErrorMapper.from_sdk_response(error) }
        end
      end
    end
  end
end